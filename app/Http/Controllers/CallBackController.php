<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\{
    Callback,
    Mail,
    Vacancy
};

class CallBackController extends Controller
{
    public function callback(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'text' => 'required|string',
        ]);
        CallBack::create($fields);
        return response()->json(['message' => 'done.']);
    }
    public function newMail(Request $request){
        
    }
}
