<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Room;
use App\Models\About;
use App\Models\Recreation;

class PagesController extends Controller
{
    public function about(){
        $abouts = About::all();
        return view('pages.about',compact('abouts'));                 
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
        $recreations =Recreation::paginate(6);
        return view('pages.recreation',compact('recreations'));                 
    }
}
