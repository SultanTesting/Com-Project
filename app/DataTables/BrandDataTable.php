<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
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
            $editBtn = "<a href='".route('admin.brand.edit', $query->id)."' class='btn btn-sm btn-info'>
            <i class='far fa-edit'></i></a>";

            $deleteBtn = "<a href='".route('admin.brand.destroy', $query->id)."' class='btn btn-sm btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
            return $editBtn.$deleteBtn;
        })
        ->addColumn('status', function($query)
        {
            $active = __('Active');
            $inActive = __('Inactive');

            if($query->status == 'Active')
            {
                return "<label class='custom-switch mt-2'>
                    <input type='checkbox' checked name='custom-switch-checkbox' data-id='".$query->id."' class='custom-switch-input change-status'/>
                    <span class='custom-switch-indicator'></span>
                    <span class='ml-2 badge badge-success'>$active</span>
                </label>";
            }
            else
            {
                return "<label class='custom-switch mt-2'>
                    <input type='checkbox' name='custom-switch-checkbox' data-id='".$query->id."' class='custom-switch-input change-status'/>
                    <span class='custom-switch-indicator'></span>
                    <span class='ml-2 badge badge-danger'>$inActive</span>
                </label>";
            }
            })
            ->addColumn('logo', function($query)
            {
                if($query->logo)
                {
                    return "<img width='100px' src='".asset($query->logo)."'>";
                }

                    return "<img width='100px' src='".asset('frontend/images/no-image.jpg')."'>";
            })
            ->addColumn('created_at', function(Brand $brand)
            {
                return $brand->uploadDate();
            })
            ->addColumn('featured', function($query)
            {
                if($query->featured == "Yes")
                {
                    return "<span class='badge badge-success'>".__('Yes')."</span>";
                }

                    return "<span class='badge badge-danger'>".__('No')."</span>";
            })
                ->addIndexColumn() // search for index_column datatables.php
                ->rawColumns(['action', 'status', 'logo', 'featured'])
                ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('brand-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->language(langSelect())
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
            Column::make('name')
                ->addClass('font-weight-bold')
                ->width(200),
            Column::make('logo')->width(300),
            Column::make('featured'),
            Column::make('status'),
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
        return 'Brand_' . date('YmdHis');
    }
}
