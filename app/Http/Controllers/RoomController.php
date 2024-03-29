<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Room::select('*'))
            ->addColumn('action', 'rooms.room-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('rooms.room');
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
            'size'=> 'required|string|max:50',
            'bed'=> 'required|string|max:50',
            'capacity' => 'required',
            'services'=> 'required|string|max:150',
            'description'=> 'required|string',
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
                $roomId = $request->id;
        
                $room   =   Room::updateOrCreate(
                            [
                            'id' => $roomId
                            ],
                            [
                            'name' => $request->name, 
                            'price' => $request->price, 
                            'photo' => $path,
                            'size' => $request->size,
                            'capacity' => $request->capacity,
                            'bed' => $request->bed,
                            'services' => $request->services,
                            'description' => $request->description
                            ]);    
                                
                return Response()->json($room);
    
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
        $room = Room::where($where)->first();
      
        return Response()->json($room);
    }
      
      
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\food $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $room= Room::where('id',$request->id)->delete();
      
        return Response()->json($room);
    }
}
