<?php

namespace App\DataTables\Admin;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
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
            $editBtn = "<a href='".route('admin.coupon.edit', $query->id)."'
            class='btn btn-sm btn-info ml-2'>
            <i class='far fa-edit'></i></a>";

            $deleteBtn = "<a href='".route('admin.coupon.destroy', $query->id)."'
            class='btn btn-sm btn-danger ml-2 delete-item'>
            <i class='far fa-trash-alt'></i></a>";

            return $editBtn.$deleteBtn;
        })
            ->addColumn('status', function($query)
            {
                if($query->status == 'active')
                {
                    return "<label class='custom-switch mt-2'>
                        <input type='checkbox' checked name='custom-switch-checkbox' data-id='".$query->id."' class='custom-switch-input change-status'/>
                        <span class='custom-switch-indicator'></span>
                        <span class='ml-2 badge badge-success'>".__('Active')."</span>
                    </label>";
                }
                else
                {
                    return "<label class='custom-switch mt-2'>
                        <input type='checkbox' name='custom-switch-checkbox' data-id='".$query->id."' class='custom-switch-input change-status'/>
                        <span class='custom-switch-indicator'></span>
                        <span class='ml-2 badge badge-danger'>".__('Inactive')."</span>
                    </label>";
                }
            })
            ->addColumn('start_date', function($query)
            {
                return "<span class='badge badge-primary'>$query->start_date</span>";
            })
            ->addColumn('end_date', function($query)
            {
                return "<span class='badge badge-danger'>$query->end_date</span>";
            })
            ->addColumn('created_at', function($query)
            {
                return $query->created_at->diffForHumans();
            })
            ->addIndexColumn() // search for index_column datatables.php
            ->rawColumns(['status', 'action', 'start_date', 'end_date'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Coupon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('coupon-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->language(langSelect())
                    ->responsive()
                    ->autoWidth(false)
                    //->dom('Bfrtip')
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
            Column::make('name')->addClass('font-weight-bold'),
            Column::make('code')->addClass('font-weight-bold'),
            Column::make('discount')->addClass('text-center'),
            Column::make('discount_type')->addClass('text-center'),
            Column::make('start_date')->addClass('text-center'),
            Column::make('end_date')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
            Column::make('total_used')->addClass('text-center'),
            Column::make('created_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Coupon_' . date('YmdHis');
    }
}
