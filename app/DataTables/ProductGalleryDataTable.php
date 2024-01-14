<?php

namespace App\DataTables;

use App\Models\ProductGallery;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductGalleryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query, ProductGallery $productGallery): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query)
            {
                $deleteBtn = "<a href='".route('admin.child-category.destroy', $query->id)."' class='btn btn-sm btn-danger ml-2 mr-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                return $deleteBtn;
            })

            ->addColumn('images', function($query)
            {
                return "<img src='".asset($query->images)."' width='200px'>";
            })

            ->addColumn('created_at', function($productGallery)
            {
                return $productGallery->uploadDate();
            })

            ->rawColumns(['action', 'images'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductGallery $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productgallery-table')
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

            Column::make('id')->width(100),
            Column::make('images'),
            Column::make('created_at')->width(100),
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
        return 'ProductGallery_' . date('YmdHis');
    }
}
