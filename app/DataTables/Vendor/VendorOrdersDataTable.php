<?php

namespace App\DataTables\Vendor;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorOrdersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query)
        {
            $showBtn = "<a href='".route('vendor.orders.show', $query->id)."'
            class='btn btn-sm btn-primary ms-2'>
            <i class='far fa-eye'></i></a>";

            return $showBtn;
        })
        ->addColumn('amount', function($query)
        {
            $data = ['order_id' => $query->id, 'vendor_id' => auth()->user()->vendor->id];
            $orders = OrderProduct::where($data)->get();
            $value = 0;

            foreach($orders as $order)
            {
                $value += $order->unit_price * $order->qty;
            }

            return number_format($value) . ' ' . $query->currency_icon;

        })
        ->addColumn('invoice_id', function($query)
        {
            return "#" . $query->invoice_id;
        })
        ->addColumn('order_qty', function($query)
        {
            return $query->order_qty . ' ' . Str::of('Piece')->plural($query->order_qty);
        })
        ->addColumn('customer', function($query)
        {
            return $query->user->name;
        })
        ->addColumn('order_status', function($query){
            if($query->orderProducts[0]->vendor_order_status === 'shipped')
            {
                return "<span class='badge bg-success'>Shipped</span>";
            }elseif($query->orderProducts[0]->vendor_order_status === 'canceled')
            {

                return "<span class='badge bg-danger'>Canceled</span>";
            }

                return "<span class='badge bg-primary'>NEW</span>";


        })
        ->addColumn('payment_status', function($query)
        {
            if($query->payment_status == 1)
            {
                return "<i style='color: green; font-size: 20px;' class='fas fa-check-square fa-lg'></i>";
            }
                return "<i style='font-size: 22px;' class='far fa-clock text-danger'></i>";

        })
        ->addColumn('date', function($query)
        {
            return "<div class='text-white bg-secondary' style='font-size: 13px;'>
            ".date('d M, Y', strtotime($query->created_at))."
            </div>";
        })
            ->filterColumn('invoice_id', function($query, $keyword)
            {
                $query->where('invoice_id', 'like', "%$keyword%");
            })
            ->filterColumn('payment_method', function($query, $keyword)
            {
                $query->where('payment_method', 'like', "%$keyword%");
            })
            ->rawColumns(['action', 'amount', 'customer', 'order_status', 'order_qty', 'payment_status', 'date'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        if(request()->filter)
        {
            return $model->whereHas('orderProducts', function($query)
            {
                $filter = ['vendor_order_status' => request()->filter, 'vendor_id' => auth()->user()->vendor->id];
                $query->where($filter);
            })->newQuery();
        }
            return $model->whereHas('orderProducts', function($query)
            {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('order-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->responsive(true)
                    ->languageUrl(langSelect())
                    ->autoWidth(false)
                    // ->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('invoice_id')
                ->addClass('fw-bold'),
            Column::make('customer'),
            Column::make('date')
                ->addClass('text-center'),
            Column::make('amount')
                ->addClass('fw-bold text-dark text-center'),
            Column::make('payment_method')
                ->addClass('text-dark fw-bold text-center'),
            Column::make('order_qty')
                ->addClass('text-center fw-bold'),
            Column::make('order_status')
                ->addClass('text-center'),
            Column::make('payment_status')
                ->addClass('text-center'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorOrders_' . date('YmdHis');
    }
}
