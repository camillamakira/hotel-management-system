<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(User::select('*'))
            ->addColumn('action', 'users.user-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('users.user');
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
                $userId = $request->id;
        
                $user   =   User::updateOrCreate(
                            [
                            'id' => $userId
                            ],
                            [
                            'first_name' => $request->first_name, 
                            'last_name' => $request->last_name, 
                            'email' => $request->email,
                            'role' => $request->role,
                            'phone_no' => $request->phone_no,
                            'photo' => $path,
                            'password' => Hash::make('golfhotel2023')
                            ]);    
                                
                return Response()->json($user);
    
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
        $user = User::where($where)->first();
      
        return Response()->json($user);
    }
      
      
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\food $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user= User::where('id',$request->id)->delete();
      
        return Response()->json($user);
    }
}
