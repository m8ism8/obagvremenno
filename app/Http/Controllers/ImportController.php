<?php

namespace App\Http\Controllers;
use App\Imports\BackpacksImport;
use App\Imports\BagsImport;
use App\Imports\ExportProducts;
use App\Imports\KaspiImport;
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

    public function import(Request $request)
    {
        if($request->file) {
            Storage::deleteDirectory('/public/excel');
            $fileName = $request->file->getClientOriginalName();
            $request->file('file')->storeAs('/excel', $fileName, 'public');
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


    public function indexBackpacks(){
        return view('backpacksExcelImport');
    }

    public function backpacks(Request $request)
    {
        if($request->file) {
            Storage::deleteDirectory('/public/excel');
            $fileName = $request->file->getClientOriginalName();
            $file = $request->file('file')->storeAs('/excel', $fileName, 'public');
            Excel::import(new BackpacksImport, '/public/excel/'.$fileName);
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


    public function indexBags(){
        return view('bagsExcelImport');
    }

    public function bags(Request $request)
    {
        if($request->file) {
            Storage::deleteDirectory('/public/excel');
            $fileName = $request->file->getClientOriginalName();
            $file = $request->file('file')->storeAs('/excel', $fileName, 'public');
            Excel::import(new BagsImport(), '/public/excel/'.$fileName);
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


    public function indexKaspi(){
        return view('kaspiExcelImport');
    }

    public function kaspi(Request $request)
    {
        if($request->file) {
            Storage::deleteDirectory('/public/excel');
            $fileName = $request->file->getClientOriginalName();
            $file = $request->file('file')->storeAs('/excel', $fileName, 'public');
            Excel::import(new KaspiImport, '/public/excel/'.$fileName);
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

    public function export()
    {
        dd(1);
        return Excel::download(new ExportProducts(), 'products.xlsx');
    }
}
