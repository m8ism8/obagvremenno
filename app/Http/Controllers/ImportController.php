<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{

    public function index(){
        return view('excelImport');
    }

    public function import(Request $request){
        if($request->file) {
            Storage::deleteDirectory('/public/excel');
            $fileName = $request->file->getClientOriginalName();
            $file = $request->file('file')->storeAs('/excel', $fileName, 'public');
            Excel::import(new ProductsImport, '/public/excel/'.$fileName);
            return redirect('/admin/products')->with([
                'message'    => 'Продукты были добавлены на сайт!',
                'alert-type' => 'success',
            ]);
        }
        else{
            return redirect()->back()->with([
                'message'    => 'Файл не был найден',
                'alert-type' => 'error',
            ]);
        }
    }
}
