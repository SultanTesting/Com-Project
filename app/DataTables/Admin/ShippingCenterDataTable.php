<?php

namespace App\DataTables\Admin;

use App\Models\GeneralSettings;
use App\Models\ShippingCenter;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShippingCenterDataTable extends DataTable
{
    protected function currency()
    {
        return GeneralSettings::first()->currency_icon;
    }

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
                $editBtn = "<a href='".route('admin.shipping.edit', $query->id)."'
                class='btn btn-sm btn-info ml-2'>
                <i class='far fa-edit'></i></a>";

                $deleteBtn = "<a href='".route('admin.shipping.destroy', $query->id)."'
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
                        <span class='ml-2 badge badge-light'>".__('Active')."</span>
                    </label>";
                }
                else
                {
                    return "<label class='custom-switch mt-2'>
                        <input type='checkbox' name='custom-switch-checkbox' data-id='".$query->id."' class='custom-switch-input change-status'/>
                        <span class='custom-switch-indicator'></span>
                        <span class='ml-2 badge badge-dark'>".__('Inactive')."</span>
                    </label>";
                }
            })
            ->addColumn('cost', function($query)
            {
                if($query->cost)
                {
                    return "<span>$query->cost [ ".$this->currency()." ]</span>";
                }

                    return "<span class='badge badge-secondary'>Free</span>";
            })
            ->addColumn('min_cost', function($query)
            {
                if($query->min_cost)
                {
                    return "<span>$query->min_cost [ ".$this->currency()." ]</span>";
                }
                    return "<span class='badge badge-secondary'>NO</span>";
            })
            ->addColumn('type', function($query)
            {
                switch ($query->type) {
                    case 'subscription':
                        return "<span class='badge badge-warning'>".__('MemberShip')."</span>";
                        break;
                    case 'min_amount':
                        return "<span class='badge badge-info'>".__('Minimum Order Amount')."</span>";
                        break;
                    default:
                        return "<span class='badge badge-primary'>".__('Basic')."</span>";
                        break;
                }
            })
            ->addColumn('created_at', function($query)
            {
                return $query->created_at->diffForHumans();
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status', 'type', 'min_cost', 'cost'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ShippingCenter $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('shippingcenter-table')
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
            Column::make('type')->addClass('text-center'),
            Column::make('min_cost')->addClass('text-center'),
            Column::make('cost')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
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
        return 'ShippingCenter_' . date('YmdHis');
    }
}
