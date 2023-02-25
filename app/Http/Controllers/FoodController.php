<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Food::select('*'))
            ->addColumn('action', 'foods.food-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('foods.food');
    }
      
      
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
 
        $foodId = $request->id;
 
        $food  =   Food::updateOrCreate(
                    [
                     'id' => $foodId
                    ],
                    [
                    'name' => $request->name, 
                    'price' => $request->price
                    ]);    
                         
        return Response()->json($food);
 
    }
      
      
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\food $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $food = Food::where($where)->first();
      
        return Response()->json($food);
    }
      
      
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\food $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $food= Food::where('id',$request->id)->delete();
      
        return Response()->json($food);
    }
}
