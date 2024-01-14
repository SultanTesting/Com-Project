<?php

namespace App\DataTables;

use App\Models\ProductVariants;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductVariantsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query, ProductVariants $productVariants): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query)
        {
            $dir = (dirSelect() == 'rtl') ? 'mr-2' : '' ;

            $itemsBtn = "<a
            href='".route('admin.product.variant-item.index',
            ['productId' => $query->product_id, 'variantId' => $query->id])."' class='btn btn-sm btn-primary mr-2'>
            <i class='fas fa-server'></i></a>";

            $editBtn = "<a href='".route('admin.product-variants.edit', $query->id)."' class='btn btn-sm btn-info $dir'>
            <i class='far fa-edit'></i></a>";

            $deleteBtn = "<a href='".route('admin.product-variants.destroy', $query->id)."' class='btn btn-sm btn-danger ml-2 $dir delete-item'><i class='far fa-trash-alt'></i></a>";
            return $itemsBtn.$editBtn.$deleteBtn;
        })
        ->addColumn('status', function($query)
            {
                if($query->status == 'active')
                {
                    return "<label class='custom-switch mt-2'>
                        <input type='checkbox' checked name='custom-switch-checkbox' data-id='".$query->id."' class='custom-switch-input change-status'/>
                        <span class='custom-switch-indicator'></span>
                        <span class='ml-2 mr-2 badge badge-success'>".__('Active')."</span>
                    </label>";
                }
                else
                {
                    return "<label class='custom-switch mt-2'>
                        <input type='checkbox' name='custom-switch-checkbox' data-id='".$query->id."' class='custom-switch-input change-status'/>
                        <span class='custom-switch-indicator'></span>
                        <span class='ml-2 mr-2 badge badge-danger'>".__('Inactive')."</span>
                    </label>";
                }
            })
        ->addColumn('created_at', function($productVariants)
        {
            return $productVariants->uploadDate();
        })

        ->addColumn('updated_at', function($query)
        {
            return $query->updated_at->diffForHumans();
        })
            ->addIndexColumn() // search for index_column datatables.php
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariants $model): QueryBuilder
    {
        return $model->where('product_id', request()->product)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productvariants-table')
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
            Column::make('name')
            ->width(200)
            ->addClass('font-weight-bold'),
            Column::make('status')->width(200),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(250)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductVariants_' . date('YmdHis');
    }
}
