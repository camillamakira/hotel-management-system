<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(About::select('*'))
            ->addColumn('action', 'about.about-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('about.about');
    }
      
      
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
    
                $aboutId = $request->id;
        
                $about  =   About::updateOrCreate(
                            [
                            'id' => $aboutId
                            ],
                            [
                            'title' => $request->title, 
                            'history' => $request->history, 
                           
                            ]);    
                                
                return Response()->json($about);

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
        $about= About::where($where)->first();
      
        return Response()->json($about);
    }
      
      
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\food $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $about= About::where('id',$request->id)->delete();
      
        return Response()->json($about);
    }
}  //

