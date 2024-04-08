<?php

namespace App\DataTables\Vendor;

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
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query)
        {

            $itemsBtn = "<a
            href='".route('vendor.item.index',
            ['product' => $query->product_id, 'variant' => $query->id])."' class='btn btn-sm btn-primary me-2'>
            <i class='fas fa-server'></i></a>";

            $editBtn = "<a href='".route('vendor.variants.edit', $query->id)."'
            class='btn btn-sm btn-info me-2'>
            <i class='far fa-edit'></i></a>";

            $deleteBtn = "<a href='".route('vendor.variants.destroy', $query->id)."'
            class='btn btn-sm btn-danger me-2 delete-item'>
            <i class='far fa-trash-alt'></i></a>";

            return $itemsBtn.$editBtn.$deleteBtn;
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

        ->addColumn('created_at', function($query)
        {
            return $query->created_at->diffForHumans();
        })

        ->addColumn('updated_at', function($query)
        {
            return $query->updated_at->diffForHumans();
        })

        ->addIndexColumn() // search for index_column datatables.php
        ->rawColumns(['action', 'created_at', 'updated_at', 'status'])
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
            Column::make('#')->width(150),
            Column::make('name')
            ->width(200)
            ->addClass('fw-bold'),
            Column::make('status')->width(150),
            Column::make('created_at')->width(150),
            Column::make('updated_at')->width(150),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
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
