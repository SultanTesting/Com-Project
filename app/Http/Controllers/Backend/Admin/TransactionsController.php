<?php

namespace App\Http\Controllers\Backend\Admin;

use App\DataTables\Admin\TransactionsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TransactionsDataTable $dataTable)
    {
        return $dataTable->render('admin.transactions.index');
    }
}
