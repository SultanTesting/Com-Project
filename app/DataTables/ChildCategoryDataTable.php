<?php

namespace App\DataTables;

use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ChildCategoryDataTable extends DataTable
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
                $editBtn = "<a href='".route('admin.child-category.edit', $query->id)."' class='btn btn-sm btn-info'>
                <i class='far fa-edit'></i></a>";

                $deleteBtn = "<a href='".route('admin.child-category.destroy', $query->id)."' class='btn btn-sm btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                return $editBtn.$deleteBtn;
            })
            ->addColumn('status', function($query)
            {
                if($query->status == 'Active')
                {
                    return "<label class='custom-switch mt-2'>
                        <input type='checkbox' checked name='custom-switch-checkbox' data-id='".$query->id."' class='custom-switch-input change-status'/>
                        <span class='custom-switch-indicator'></span>
                        <span class='ml-2 badge badge-success'>Active</span>
                    </label>";
                }
                else
                {
                    return "<label class='custom-switch mt-2'>
                        <input type='checkbox' name='custom-switch-checkbox' data-id='".$query->id."' class='custom-switch-input change-status'/>
                        <span class='custom-switch-indicator'></span>
                        <span class='ml-2 badge badge-danger'>Inactive</span>
                    </label>";
                }
            })
            ->addColumn('created_at', function(ChildCategory $child)
            {
                return $child->uploadDate();
            })
            ->addColumn('category', function($query)
            {
                return $query->category->name;
            })
            ->addColumn('subCategory', function($query)
            {
                return $query->subCategory->name;
            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ChildCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('childcategory-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            Column::make('name')
                  ->addClass('font-weight-bold'),
            Column::make('category'),
            Column::make('subCategory'),
            Column::make('slug'),
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
        return 'ChildCategory_' . date('YmdHis');
    }
}
