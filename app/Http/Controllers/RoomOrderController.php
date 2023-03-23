<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomOrder;
use Illuminate\Support\Facades\Auth;

class RoomOrderController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(RoomOrder::select('*'))
            ->addColumn('action', 'roomorders.roomorder-action')
            ->addColumn('room', function($row){
                return $row->room->name;
            })
            ->addColumn('price', function($row){
                return $row->room->price;
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
        return view('roomorders.roomorder');
    }

    public function myOrder()
    {
        if(request()->ajax()) {
            $user = Auth::user();
            return datatables()->of(RoomOrder::select('*')->where('user_id',$user->id)->get())
            ->addColumn('action', 'user.roomorder-action')
            ->addColumn('room', function($row){
                return $row->room->name;
            })
            ->addColumn('price', function($row){
                return $row->room->price;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('user.roomorder');
    }
}
