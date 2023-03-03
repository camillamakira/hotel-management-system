<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about(){
        return view('pages.about');                 
    }
    public function rooms(){
        return view('pages.rooms');                 
    }
    public function foods(){
        return view('pages.foods');                 
    }
    public function recreation(){
        return view('pages.recreation');                 
    }
}
