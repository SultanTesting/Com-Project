<?php

namespace App\DataTables;

use App\Models\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FlashSaleItemDataTable extends DataTable
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
                $deleteBtn = "<a href='".route('admin.flash-sale.destroy',
                ['flash_sale' => $query->id, 'product' => $query->product_id])."'
                class='btn btn-sm btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                return $deleteBtn;
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

            ->addColumn('show_at_front', function($query)
            {
                if($query->show_at_front == 'yes')
                {
                    return "<div class='btn-group btn-group-toggle' data-toggle='buttons'>
                    <label class='btn btn-success active'>
                      <input type='radio' name='options' class='show_toggle' data-id='".$query->id."' id='yes' autocomplete='off' checked> ".__('Yes')."
                    </label>

                    <label class='btn btn-secondary'>
                      <input type='radio' name='options' class='show_toggle' data-id='".$query->id."' id='no' autocomplete='off'> ".__('No')."
                    </label>
                  </div>";

                }else{

                    return "<div class='btn-group btn-group-toggle' data-toggle='buttons'>
                    <label class='btn btn-secondary'>
                      <input type='radio' name='options' class='show_toggle' data-id='".$query->id."' id='yes' autocomplete='off'> ".__('Yes')."
                    </label>

                    <label class='btn btn-danger active'>
                      <input type='radio' name='options' class='show_toggle' data-id='".$query->id."' id='no' autocomplete='off' checked> ".__('No')."
                    </label>
                  </div>";
                }
            })

            ->addColumn('name', function($query)
            {
                return "<a href='".route('admin.products.edit', $query->product->id)."'>".$query->product->name."</a>";
            })

            ->addColumn('created_at', function($query)
            {
                return $query->created_at->diffForHumans();
            })

            ->addIndexColumn()
            ->rawColumns(['show_at_front', 'action', 'status', 'name'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('flashsaleitem-table')
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
            Column::make('name')->addClass('text-center font-weight-bold'),
            Column::make('show_at_front')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
            Column::make('created_at')->addClass('text-center'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
