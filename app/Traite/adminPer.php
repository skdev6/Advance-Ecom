<?php
namespace App\Traite; 

use Illuminate\Routing\Route;

trait AdminPermission{
    public function checkRequestPermission()
    {
        if(
            empty(auth()->user()->role->peression['permisson']['brand']['add']) && Route::is('admin.brand')
        ){
            return response()->view('admin.dashboard');
        }
    }
}