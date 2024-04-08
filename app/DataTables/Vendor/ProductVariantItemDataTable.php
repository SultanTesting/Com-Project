<?php

namespace App\DataTables\Vendor;

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
                $dir = (dirSelect() == 'rtl') ? 'me-2' : '' ;

                $editBtn = "<a href='".route('vendor.item.edit',
                ['item' => $query->id, 'product' => request()->product])."' class='btn btn-sm btn-info $dir'>
                <i class='far fa-edit'></i></a>";

                $deleteBtn = "<a href='".route('vendor.item.destroy', $query->id)."' class='btn btn-sm btn-danger ms-2 $dir delete-item'>
                <i class='far fa-trash-alt'></i></a>";

                return $editBtn.$deleteBtn;
            })

            ->addColumn('status', function($query)
            {
                if($query->status == 'active')
                {
                    return "<div class='form-check form-switch'>
                    <input class='form-check-input change-status' type='checkbox' checked id='flexSwitchCheckDefault'
                    data-id='".$query->id."'>
                    <label class='form-check-label badge bg-success' for='flexSwitchCheckDefault'>".__('Active')."</label>
                </div>";
                }
                else
                {
                    return "<div class='form-check form-switch'>
                    <input class='form-check-input change-status' type='checkbox' id='flexSwitchCheckDefault'
                    data-id='".$query->id."'>
                    <label class='form-check-label badge bg-secondary' for='flexSwitchCheckDefault'>".__('Inactive')."</label>
                </div>";
                }
            })

            ->addColumn('default', function($query)
            {
                if($query->default == 'yes')
                {
                    return "<span class='d-grid badge bg-success'>Yes</span>";
                }else{
                    return "<span class='d-grid badge bg-danger'>No</span>";
                }
            })

            ->addColumn('created_at', function($query)
            {
                return $query->created_at->diffForHumans();
            })

            ->rawColumns(['action', 'status', 'default', 'created_at'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        return $model->where('product_variants_id', request()->variant)->newQuery();
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
            Column::make('name')->addClass('fw-bold'),
            Column::make('price')->addClass('fw-bold'),
            Column::make('default'),
            Column::make('status')->width(150),
            Column::make('created_at')->width(150),
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
