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
 
        $validatedData = $request->validate([
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg',
            'name'=> 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'size'=> 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'quantity' => 'required',
            'services'=> 'required|regex:/^[\pL\s\-]+$/u|max:150',
            'description'=> 'required|regex:/^[\pL\s\-]+$/u|max:1050',
            ]);
    
            if($request->TotalImages > 0)
            {
                    
                for ($x = 0; $x < $request->TotalImages; $x++) 
                {
        
                    if ($request->hasFile('images'.$x)) 
                    {
                        $file      = $request->file('images'.$x);
        
                        $path = $file->store('public/images');
                        $name = $file->getClientOriginalName();
        
                    }
                }    
                $foodId = $request->id;
        
                $food   =   Food::updateOrCreate(
                            [
                            'id' => $foodId
                            ],
                            [
                            'name' => $request->name, 
                            'price' => $request->price, 
                            'photo' => $path,
                            'size' => $request->size,
                            'quantity' => $request->quantity,
                            'services' => $request->services,
                            'description' => $request->description   
                            ]);    
                                
                return Response()->json($food);
    
            }  
            else{
                return response()->json(["message" => "Please try again."]);
            } 

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
