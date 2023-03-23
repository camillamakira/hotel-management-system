<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecreationOrder;
use Illuminate\Suppot\Facades\Auth;

class RecreationOrderController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(RecreationOrder::select('*'))
            ->addColumn('action', 'recreationorders.recreationorder-action')
            ->addColumn('recreation', function($row){
                return $row->recreation->name;
            })
            ->addColumn('price', function($row){
                return $row->recreation->price;
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
        return view('recreationorders.recreationorder');
    }

    public function myOrder()
    {
        if(request()->ajax()) {
            $user = Auth::user();
            return datatables()->of(RecreationOrder::select('*')->where('user_id',$user->id)->get())
            ->addColumn('action', 'recreationorders.recreationorder-action')
            ->addColumn('recreation', function($row){
                return $row->recreation->name;
            })
            ->addColumn('price', function($row){
                return $row->recreation->price;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('user.recreationorder');
    }
}
