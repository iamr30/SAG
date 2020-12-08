<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        //
        if(\Request::ajax()){
            return Area::all();
       }
       else{
        return view('areas/areas');
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $editN='null';
        $params = [
            'editN' => $editN
        ];            
        return view('areas/areasEdit',$params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
            try{
                $area=new Area();
                $area->name=$request->name;
                $area->save();
                return 1;
            }
            catch(\Exception $exception){
                return $exception;
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
        if(\Request::ajax()){
            $area=Area::findOrFail($id);
            return $area;
            }else{
                $detailId=$id;
                $params = [
                    'detailN' => $detailId
                ];     
                return view('areas/areasDetails',$params);
            }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area,int $id)
    {
        //
        $editN=$id;
        $params = [
            'editN' => $editN
        ];     
        return view('areas/areasEdit',$params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $id)
    {
        //
        try{
        $area=Area::find($id);
        $area->name=$request->name;
        $area->save();
        return $area;
        } catch(\Exception $exception)
        {
            return $exception;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
        if(request()->isMethod("DELETE")){
            try{
                $area=Area::findOrFail($id);
                $area->delete();
                return 1;
            }
            catch(\Exception $exception)
            {
                return $exception;
            }
        }
    }
}
