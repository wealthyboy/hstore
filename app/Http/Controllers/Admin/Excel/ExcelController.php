<?php

namespace App\Http\Controllers\Admin\Excel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {   
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }

   
}
