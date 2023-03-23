<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodOrder;
use Illuminate\Support\Facades\Auth;

class FoodOrderController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(FoodOrder::select('*'))
            ->addColumn('action', 'foodorders.foodorder-action')
            ->addColumn('food', function($row){
                return $row->food->name;
            })
            ->addColumn('price', function($row){
                return $row->food->price;
            })
            ->addColumn('user', function($row){
                $firstname = $row->user->first_name;
                $lastname = $row->user->last_name;
                return $firstname.' '.$lastname;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('foodorders.foodorder');
    }

    public function myOrder()
    {
        if(request()->ajax()) {
            $user = Auth::user();
            return datatables()->of(FoodOrder::select('*')->where('user_id',$user->id)->get())
            ->addColumn('action', 'user.foodorder-action')
            ->addColumn('food', function($row){
                return $row->food->name;
            })
            ->addColumn('price', function($row){
                return $row->food->price;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('user.foodorder');
    }
}
