<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    //
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Service::select('*'))
            ->addColumn('action', 'services.service-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('services.service');
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
            'title'=> 'required|string|max:50',
            'description'=> 'required|string|max:1050',
            ]);

                $serviceId = $request->id;
        
                $service   =   Service::updateOrCreate(
                            [
                            'id' => $serviceId
                            ],
                            [
                            'title' => $request->title, 
                            'description' => $request->description
                            ]);    
                                
                return Response()->json($service);
    

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
        $service = Service::where($where)->first();
      
        return Response()->json($service);
    }
      
      
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\food $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $service= Service::where('id',$request->id)->delete();
      
        return Response()->json($service);
    }
}
