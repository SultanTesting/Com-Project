<?php

namespace App\DataTables;

use App\Models\ProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductVariantItemDataTable extends DataTable
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
            $dir = (dirSelect() == 'rtl') ? 'mr-2' : '' ;

            $editBtn = "<a href='".route('admin.product.variant-item.edit',
            ['item' => $query->id, 'product' => request()->productId])."' class='btn btn-sm btn-info $dir'>
            <i class='far fa-edit'></i></a>";

            $deleteBtn = "<a href='".route('admin.product.variant-item.destroy', $query->id)."' class='btn btn-sm btn-danger ml-2 $dir delete-item'>
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

        ->addColumn('default', function($query)
        {
            if($query->default == 'yes')
            {
                return "<span class='badge badge-success'>Yes</span>";
            }else{
                return "<span class='badge badge-danger'>No</span>";
            }
        })

        ->addColumn('created_at', function($query)
        {
            return $query->created_at->diffForHumans();
        })
            ->rawColumns(['action', 'created_at', 'status', 'default'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        return $model->where('product_variants_id', request()->variantId)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productvariantitem-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->language(langSelect())
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
            Column::make('price')->addClass('font-weight-bold'),
            Column::make('default'),
            Column::make('status'),
            Column::make('created_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(150)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductVariantItem_' . date('YmdHis');
    }
}
