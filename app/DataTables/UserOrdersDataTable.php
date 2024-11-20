<?php

namespace App\DataTables;

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

class UserOrdersDataTable extends DataTable
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
            $showBtn = "<a href='".route('user.order.show', $query->id)."'
            class='btn btn-sm btn-primary ms-2'>
            <i class='far fa-eye'></i></a>";

            return $showBtn;
        })
        ->addColumn('order_status', function($query)
        {
            switch ($query->order_status) {
                case 'pending':
                    return "<span class='badge bg-warning'>".__('Pending')."</span>";
                    break;
                case 'canceled':
                    return "<span class='badge bg-danger'>".__('Canceled')."</span>";
                    break;
                case 'processed_ready':
                    return "<span class='badge bg-secondary'>".__('Processed & Ready')."</span>";
                    break;
                case 'dropped_off':
                    return "<span class='badge bg-primary'>".__('Dropped Off')."</span>";
                    break;
                case 'shipped':
                    return "<span class='badge bg-info'>".__('Shipped')."</span>";
                    break;
                case 'out_for_delivery':
                    return "<span class='badge bg-info'>".__('Out For Delivery')."</span>";
                    break;
                case 'delivered':
                    return "<span class='badge bg-success'>".__('Delivered')."</span>";
                    break;

                default:
                    return "<span>".__('Pending')."</span>";
                    break;
            }
        })
        ->addColumn('amount', function($query)
        {
            return number_format($query->amount) . ' ' . $query->currency_icon;
        })
        ->addColumn('quantity', function($query)
        {
            return $query->order_qty . ' ' . Str::of('Piece')->plural($query->order_qty);
        })
        ->editColumn('invoice_id', function($query)
        {
            return "#" . $query->invoice_id;
        })

        ->addColumn('date', function($query)
        {
            return "<div class='text-white bg-secondary' style='font-size: 13px;'>
            ".date('d M, Y', strtotime($query->created_at))."
            </div>";
        })
        ->addColumn('payment_status', function($query)
        {
            if($query->payment_status === 1)
            {
                return "<span class='fs-2'>✅</span>";
            }
                return "<span class='fs-2'>🚫</span>";

        })
            ->filterColumn('invoice_id', function($query, $keyword)
            {
                $query->where('invoice_id', 'like', "%$keyword%");
            })
            ->filterColumn('payment_method', function($query, $keyword)
            {
                $query->where('payment_method', 'like', "%$keyword%");
            })
            ->rawColumns(['action', 'amount', 'payment_status', 'order_status', 'quantity', 'date'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->newQuery();
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
                    ->orderBy(1)
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

            Column::make('#'),
            Column::make('invoice_id'),
            Column::make('date')
                ->addClass('text-center'),
            Column::make('amount')
                ->addClass('fw-bold text-dark text-center'),
            Column::make('quantity')
                ->width(100)
                ->addClass('text-center'),
            Column::make('payment_method')
                ->addClass('text-center')
                ->width(120),
            Column::make('payment_status')
                ->addClass('text-center')
                ->width(120),
            Column::make('order_status')
                ->width(100),
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
        return 'UsersOrders_' . date('YmdHis');
    }
}
