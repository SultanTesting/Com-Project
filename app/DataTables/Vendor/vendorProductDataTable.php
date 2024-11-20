<?php

namespace App\DataTables\Vendor;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class vendorProductDataTable extends DataTable
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
            $editBtn = "<a href='".route('vendor.products.edit', $query->id)."'
            class='btn btn-sm btn-info me-1'>
            <i class='far fa-edit'></i></a>";

            $deleteBtn = "<a href='".route('vendor.products.destroy', $query->id)."'
            class='btn btn-sm btn-danger me-1 delete-item'>
            <i class='far fa-trash-alt'></i></a>";

            $drop = (dirSelect() == 'rtl') ? 'dropend' : 'dropstart';
            $more = "
            <div class='btn-group $drop'>
                <button type='button' class='btn btn-sm btn-primary dropdown-toggle ml-1' data-bs-toggle='dropdown' data-bs-display='static' aria-expanded='false'>
                <i class='fas fa-cog'></i>
                </button>
                <div class='dropdown-menu dropdown-menu-end'>

                    <a class='dropdown-item has-icon'
                    href='".route('vendor.product-gallery.index', ['product' => $query->id])."'>
                    <i class='far fa-images'></i>
                    ".__('Image Gallery')."
                    </a>

                    <a class='dropdown-item has-icon'
                     href='".route('vendor.variants.index', ['product' => $query->id])."'>
                    <i class='fas fa-exchange-alt'></i>
                    ".__('Variants')."
                    </a>

                </div>
            </div>";

            return $editBtn.$deleteBtn.$more;
        })
        ->addColumn('status', function($query)
        {
            if($query->status == 'active')
            {
                return "<div class='form-check form-switch'>
                <input class='form-check-input change-status' type='checkbox' checked id='flexSwitchCheckDefault'
                data-id='".$query->id."'><span class='form-check-label badge bg-success' for='flexSwitchCheckDefault'>".__('Active')."</span>
                </div>";
            }
            else
            {
                return "<div class='form-check form-switch'>
                <input class='form-check-input change-status' type='checkbox' id='flexSwitchCheckDefault'
                data-id='".$query->id."'>
                <span class='form-check-label badge bg-secondary' for='flexSwitchCheckDefault'>".__('Inactive')."</span>
              </div>";
            }
        })
        ->addColumn('image', function($query)
        {
            return "<img src='".asset($query->thumb_image)."' width='100px' class='img-thumbnail'/>";
        })
        ->addColumn('created_at', function($query)
        {
            return date('d M, Y', strtotime($query->created_at));
        })
        ->addColumn('price', function($query)
        {
            return number_format($query->price);
        })
        ->addColumn('offer_price', function($query)
        {
            return number_format($query->offer_price);
        })
        ->addColumn('offer_start', function($query)
        {
            if($query->offer_start_date)
            {
                return "<span class='badge bg-primary'>$query->offer_start_date</span>";
            }
                return "<span class='badge bg-secondary'>No Offer Date</span>";
        })
        ->addColumn('offer_end', function($query)
        {
            if($query->offer_end_date)
            {
                return "<span class='badge bg-danger'>$query->offer_end_date</span>";
            }
                return "<span class='badge bg-secondary'>No Offer Date</span>";
        })

        ->addColumn('approved', function($query)
        {
            if($query->approved == 'pending')
            {
                return "<span class='badge bg-warning'>Pending</span>";

            }elseif($query->approved == 'published')
            {
                return "<span class='badge bg-success'>Published</span>";
            }
                return "<span class='badge bg-danger'>Failed</span>";
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

            ->addIndexColumn() // search for index_column datatables.php
            ->rawColumns(['action', 'created_at', 'status', 'approved', 'image', 'offer_start', 'offer_end', 'product_type', 'price', 'offer_price'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproduct-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->language(langSelect())
                    ->responsive(true)
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
                ->addClass('fw-bold')
                ->width(150),
            Column::make('image')
                ->addClass('text-center')
                ->width(100),
            Column::make('quantity'),
            Column::make('price'),
            Column::make('offer_price'),
            Column::make('offer_start')
                ->addClass('fw-bold'),
            Column::make('offer_end')
                ->addClass('fw-bold'),
            Column::make('status')
                ->addClass('text-center'),
            Column::make('approved')
                    ->addClass('text-center'),
            Column::make('product_type')
                ->addClass('text-center'),
            Column::make('created_at')
                ->width(100),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(135)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'vendorProduct_' . date('YmdHis');
    }
}
