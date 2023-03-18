<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recreation;

class RecreationController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Recreation::select('*'))
            ->addColumn('action', 'recreations.recreation-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('recreations.recreation');
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
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg'
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
                $recreationId = $request->id;
        
                $recreation   =   Recreation::updateOrCreate(
                            [
                            'id' => $recreationId
                            ],
                            [
                            'name' => $request->name, 
                            'price' => $request->price, 
                            'photo' => $path,
                            'size' => $request->size,
                            'capacity' => $request->capacity,
                            'services' => $request->services,
                            'description' => $request->description
                            ]);    
                                
                return Response()->json($recreation);
    
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
        $recreation = Recreation::where($where)->first();
      
        return Response()->json($recreation);
    }
      
      
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\food $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $recreation= Recreation::where('id',$request->id)->delete();
      
        return Response()->json($recreation);
    }
}
