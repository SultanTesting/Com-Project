<?php

namespace App\DataTables\Admin;

use App\Models\GeneralSettings;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransactionsDataTable extends DataTable
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
                if($query->order_id)
                {
                    $showBtn = "<a href='".route('admin.order.show', $query->order_id)."'
                    class='btn btn-sm btn-primary ml-2'>
                    <i class='far fa-eye'></i></a>";

                    $deleteBtn = "<a href='".route('admin.order.destroy', $query->id)."'
                    class='btn btn-sm btn-danger ml-2 delete-item'>
                    <i class='far fa-trash-alt'></i></a>";

                    return $showBtn.$deleteBtn;
                }

                    $deleteBtn = "<a href='".route('admin.order.destroy', $query->id)."'
                    class='btn btn-sm btn-danger ml-2 delete-item'>
                    <i class='far fa-trash-alt'></i></a>";

                    return $deleteBtn;
            })
            ->addColumn('amount', function($query)
            {
                if($query->order_id)
                {
                    return number_format($query->amount) . ' ' . $query->order->currency_icon;
                }
                    return number_format($query->amount);
            })
            ->addColumn('converted_amount', function($query)
            {
                return number_format($query->converted_amount);
            })
            ->addColumn('order_id', function($query)
            {
                if($query->order_id)
                {
                    return $query->order_id;
                }
                    return "<span class='badge badge-danger'>Deleted</span>";
            })
            ->addColumn('customer', function($query)
            {
                return $query->user_name;
            })
            ->addColumn('date', function($query)
            {
                return date('d M, Y', strtotime($query->created_at));
            })

            ->filterColumn('customer', function($query, $keyword)
            {
                $query->where('user_name', 'like', "%$keyword%");
            })
            ->rawColumns(['action', 'created_at', 'amount', 'converted_amount', 'order_id', 'date', 'customer'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Transaction $model): QueryBuilder
    {
        if(request()->filter)
        {
            return $model->where('payment_method', request()->filter)->orderBy('created_at', 'desc')->newQuery();
        }elseif(request()->from && request()->to)
        {
            return $model->whereBetween('created_at', [request()->from, request()->to])->newQuery();
        }
            return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('transactions-table')
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
            Column::make('order_id'),
            Column::make('transaction_id')
                ->addClass('font-weight-bold'),
            Column::make('date')
                ->addClass('text-center font-weight-bold'),
            Column::make('customer'),
            Column::make('payment_method'),
            Column::make('amount')
                ->addClass('font-weight-bold'),
            Column::make('converted_amount'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(80)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transactions_' . date('YmdHis');
    }
}
