<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
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
            $showBtn = "<a href='".route('admin.order.show', $query->id)."'
            class='btn btn-sm btn-primary ml-2'>
            <i class='far fa-eye'></i></a>";

            $deleteBtn = "<a href='".route('admin.order.destroy', $query->id)."'
            class='btn btn-sm btn-danger ml-2 delete-item'>
            <i class='far fa-trash-alt'></i></a>";

            return $showBtn.$deleteBtn;
        })
        ->addColumn('amount', function($query)
        {
            return number_format($query->amount) . '&nbsp' . $query->currency_icon;
        })
        ->addColumn('customer', function($query)
        {
            return $query->user->name;
        })
        ->addColumn('order_status', function($query){
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
        ->addColumn('payment_status', function($query)
        {
            if($query->payment_status == 1)
            {
                return "<i style='color: green; font-size: 20px;' class='fas fa-check-square fa-lg'></i>";
            }
                return "<i style='font-size: 22px;' class='far fa-clock text-danger'></i>";

        })
        ->addColumn('created_at', function($query)
        {
            return date('d M, Y', strtotime($query->created_at));
        })
            ->rawColumns(['action', 'amount', 'customer', 'order_status', 'payment_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        if(request()->filter){

            return $model->where('order_status', request()->filter)->orderBy('created_at', 'desc')
            ->newQuery();
        }
            return $model->newQuery();
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
                    //->dom('Bfrtip')
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
                ->addClass('font-weight-bold'),
            Column::make('customer'),
            Column::make('amount')
                ->addClass('font-weight-bold text-dark'),
            Column::make('order_qty')
                ->addClass('text-center'),
            Column::make('payment_method')
                ->addClass('text-dark font-weight-bold text-center'),
            Column::make('order_status')
                ->addClass('text-center'),
            Column::make('payment_status')
                ->addClass('text-center'),
            Column::make('created_at')
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
        return 'Order_' . date('YmdHis');
    }
}
