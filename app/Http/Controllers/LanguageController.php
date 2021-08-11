<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function bangla()
    {
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'bangla');
        return redirect()->back();
    }
    public function english()
    {
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'english');
        return redirect()->back();
    }
}
