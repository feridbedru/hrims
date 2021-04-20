<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function switch(Request $request, $Locale)
    {
        session(['APP_LOCALE' =>$Locale]);
        return redirect()->back();

    }

}
