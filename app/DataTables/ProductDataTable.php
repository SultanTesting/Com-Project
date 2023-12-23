<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query, Product $product): EloquentDataTable
    {
        return (new EloquentDataTable($query))

        ->addColumn('action', function($query)
        {
            $editBtn = "<a href='".route('admin.products.edit', $query->id)."' class='btn btn-sm btn-info ml-2'>
            <i class='far fa-edit'></i></a>";

            $deleteBtn = "<a href='".route('admin.products.destroy', $query->id)."' class='btn btn-sm btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";

            $drop = (dirSelect() == 'rtl') ? 'dropright' : 'dropleft';
            $more = "
            <div class='btn-group $drop'>
                <button type='button' class='btn btn-sm btn-primary dropdown-toggle ml-2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                <i class='fas fa-cog'></i>
                </button>
                <div class='dropdown-menu'>
                    <a class='dropdown-item has-icon'
                    href='".route('admin.product-gallery.index', ['product' => $query->id])."'>
                    <i class='far fa-images'></i>".__('Image Gallery')."
                    </a>
                    <a class='dropdown-item has-icon' href=''>Another action</a>
                    <a class='dropdown-item has-icon' href=''>Something else here</a>
                </div>
            </div>";

            return $editBtn.$deleteBtn.$more;
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
        ->addColumn('image', function($query)
        {
            return "<img src='".asset($query->thumb_image)."' width='100px'/>";
        })
        ->addColumn('created_at', function($product)
        {
            return $product->uploadDate();
        })
        ->addColumn('offer_start_date', function($query)
        {
            if($query->offer_start_date)
            {
                return "<span class='badge badge-primary'>$query->offer_start_date</span>";
            }
                return "<span class='badge badge-secondary'>No Offer Date</span>";
        })
        ->addColumn('offer_end_date', function($query)
        {
            if($query->offer_end_date)
            {
                return "<span class='badge badge-danger'>$query->offer_end_date</span>";
            }
                return "<span class='badge badge-secondary'>No Offer Date</span>";
        })
        ->addColumn('product_type', function($query)
        {
            if($query->product_type == 'new')
            {
                return "<span style='font-size:25px'>🆕</span>";
            }elseif($query->product_type == 'top')
            {
                return "<span style='font-size:25px'>🔝</span>";
            }
                return "<span style='font-size:25px'>⭐</span>";
        })

        ->rawColumns(['action', 'created_at', 'status', 'image', 'offer_start_date', 'offer_end_date', 'product_type'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->language(langSelect())
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
                ->addClass('font-weight-bold')
                ->width(150),
            Column::make('image')
                ->width(100),
            Column::make('quantity'),
            Column::make('price'),
            Column::make('offer_price'),
            Column::make('offer_start_date')
                ->addClass('font-weight-bold'),
            Column::make('offer_end_date')
                ->addClass('font-weight-bold'),
            Column::make('status'),
            Column::make('product_type')
                ->addClass('text-center'),
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
        return 'Product_' . date('YmdHis');
    }
}
