<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{

    public function index(){
        return view('excelImport');
    }

    public function import(){
        Excel::import(new ProductsImport, 'o-bag-products.xlsx');
        return redirect('/admin')->with([
            'message'    => 'Продукты были добавлены на сайт!',
            'alert-type' => 'success',
        ]);
    }
}
