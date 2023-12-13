<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query, Slider $slider): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('action', function($query)
            {
                $editBtn = "<a href='".route('admin.slider.edit', $query->id)."' class='btn btn-sm btn-info'>
                <i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('admin.slider.destroy', $query->id)."' class='btn btn-sm btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                return $editBtn.$deleteBtn;
            })

            ->addColumn('banner', function($query)
            {
                if($query->banner)
                {
                    return "<img width='150px' src='".asset($query->banner)."'></img>";
                }
                    return "<img width='150px' src='".asset('frontend/images/no-image.jpg')."'></img>";
            })

            ->addColumn('title', function($query)
            {
                return "<a href='".route('admin.slider.show', $query->id)."'>$query->title</a>";
            })

            ->addColumn('created_at', function($slider)
            {
                return $slider->uploadDate();
            })

            ->addColumn('status', function($query)
            {
                if($query->status == 'Active')
                {
                    return "<span class='badge badge-success'>".__('Active')."</span>";
                }
                else
                {
                    return "<span class='badge badge-danger'>".__('Inactive')."</span>";
                }
            })
            ->addIndexColumn()
            ->rawColumns(['banner', 'action', 'title', 'created_at', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('slider-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            Column::make('DT_RowIndex'),
            Column::make('banner'),
            Column::make('title'),
            Column::make('serial'),
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
        return 'Slider_' . date('YmdHis');
    }
}
