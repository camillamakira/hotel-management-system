<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Room;

class PagesController extends Controller
{
    public function about(){
        return view('pages.about');                 
    }
    public function rooms(){
        $rooms =Room::paginate(6);
        return view('pages.rooms',compact('rooms'));                 
    }
    public function foods(){
        $foods = Food::all();
        return view('pages.foods', compact('foods'));                 
    }
    public function recreation(){
        return view('pages.recreation');                 
    }
}
