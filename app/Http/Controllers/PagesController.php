<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Room;
use App\Models\About;
use App\Models\Service;
use App\Models\Recreation;

class PagesController extends Controller
{
    public function about(){
        $abouts = About::all();
        $services = Service::latest()->take(5)->get();
        return view('pages.about',compact('abouts','services'));                 
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

    public function singleRoom($id)
    {
        $singleroom = Room::find($id);
        return view('pages.singleroom',[
            'singleroom' => $singleroom
        ]);
    }

    public function singleFood($id)
    {
        $singlefood = Food::find($id);
        return view('pages.singlefood',[
            'singlefood' => $singlefood
        ]);
    }

    public function singleRecreation($id)
    {
        $singlerecreation = Recreation::find($id);
        return view('pages.singlerecreation',[
            'singlerecreation' => $singlerecreation
        ]);
    }
}
