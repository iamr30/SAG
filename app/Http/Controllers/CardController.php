<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
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
        $all=Card::with('users_cdu')->get();
        return $all;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $card=Card::select("*")
                ->where("id_card", "=",$request->id_card)->first();
            if($card!=null){
                return ['value'=>0,'card'=>null];
            }
            try{
                $Card=new Card();
                $Card->id_userCDU=$request->id_userCDU;
                $Card->id_card=$request->id_card;
                $Card->save();
                return ['value'=>1,'card'=>$Card];
            }
            catch(\Exception $exception){
                return ['value'=>2,'error'=>$exception];
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $Card
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
            $Card=Card::findOrFail($id);
            return $Card->users_cdu; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $Card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $Card,int $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $Card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $id)
    {
        //
        try{
            $Card=Card::findOrFail($id);
            $Card->id_userCDU=$request->id_userCDU;
            $Card->id_card=$request->id_card;
            $Card->save();
            return 1;
        }
        catch(\Exception $exception){
            return $exception;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $Card
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
        if(request()->isMethod("DELETE")){
            try{
                $c=Card::find($id);
                $c->delete();
            }
            catch(\Exception $exception)
            {
                return $exception;
            }
        }
        return 1;
    }
}
