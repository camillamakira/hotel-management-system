<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Room;
use App\Models\About;
use App\Models\Service;
use App\Models\Recreation;
use App\Models\RoomOrder;
use App\Models\FoodOrder;
use App\Models\RecreationOrder;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function index(){
        $abouts = About::all();
        $services = Service::latest()->take(6)->get();
        $allrooms = Room::all();
        $rooms = Room::latest()->take(4)->get();
        return view('index',compact('abouts','services','rooms','allrooms'));
    }

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

    public function search(Request $request)
    {
        $rooms = Room::where('name', 'like', '%' . request('name') . '%')
        ->orWhere('capacity', 'like', '%' . request('capacity') . '%')
        ->orWhere('price', 'like', '%' . request('price') . '%')->get();
            
        return view('pages.search')->with('rooms', $rooms);
    }

    public function guestBookRoom(Request $request)
    {
        $request->session()->flash('successMsg','Please login to book any room!');
        return view('auth.login');
    }

    public function authBookRoom(Request $request)
    {
        $request->session()->flash('successMsg','Room added to your bookings. Please take a look at more of our hotel rooms.');
        $roomorder = RoomOrder::create([
            'room_id' => $request->room_id,
            'user_id' => Auth::user()->id
        ]);
        $roomorder->save();
        $rooms =Room::paginate(6);

        return view('pages.rooms',compact('rooms'));
    }

    public function guestBookFood(Request $request)
    {
        $request->session()->flash('successMsg','Please login to order any food!');
        return view('auth.login');
    }

    public function authBookFood(Request $request)
    {
        $request->session()->flash('successMsg','Food added to your orders. Please take a look at more of our hotel foods.');
        $foodorder = FoodOrder::create([
            'food_id' => $request->food_id,
            'user_id' => Auth::user()->id
        ]);
        $foodorder->save();
        $foods =Food::paginate(6);

        return view('pages.foods',compact('foods'));
    }

    public function guestBookRecreation(Request $request)
    {
        $request->session()->flash('successMsg','Please login to book any recreation facility!');
        return view('auth.login');
    }

    public function authBookRecreation(Request $request)
    {
        $request->session()->flash('successMsg','Recreation facility added to your orders. Please take a look at more of our hotel recreation facilities.');
        $recreationorder = RecreationOrder::create([
            'recreation_id' => $request->recreation_id,
            'user_id' => Auth::user()->id
        ]);
        $recreationorder->save();
        $recreations =Recreation::paginate(6);

        return view('pages.recreation',compact('recreations'));
    }
}
