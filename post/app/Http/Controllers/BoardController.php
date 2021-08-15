<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Columns;
use App\Models\Cards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    //
    public function index(){
        $columns=Columns::get();
        return view('board',['columns'=>$columns]);
    }
    public function addColumn(){
        
    //since we're not authenticating we just gona point to the first user in our database
        $user=User::get()->first();
        $columns=Columns::get();

        $title='Column '.$columns->count()+1;

        $user->columns()->create([
            'title'=>$title
        ]);


        //get this newly added column's id and return in response
        
        
        $id=Columns::max('id');
        //$col=DB::table("columns")->get(); //returns Support\Collection with no relationship tracking
        $col=Columns::get()->where('id',$id); //returns Eloquent\Collection with relationship tracking
        
        $val=null;
        foreach($col as $c){
            $val=$c;
        }
        return view('column',['column'=>$val]);
        //return view('column',['col_id'=>Columns::max('id'),'title'=>$title]);
    }
    public function addCard(Request $request){
        
        

    $col_id=$request->col;

        $cards=Cards::get();
        $title='Card '.$cards->count()+1;
        //dd("here");
        //get row number
        if($cards->count()){
            $col_cards=DB::table("cards")->where('column_id',$col_id)->get();
            $row_number=$col_cards->count()+1;
        }
        else{
            $row_number=1;
        }
        
       
        
        Cards::create([
            'column_id'=>$col_id,
            'title'=>$title,
            'description'=>'There are no description yet!',
            'row_number'=>$row_number
        ]);


        //get this newly added column's id and return in response
        
        //$card=DB::table("cards")->where('id',Cards::max('id'))->get();
        
        $card=Cards::get()->where('id',Cards::max('id')); //returns Eloquent\Collection with relationship tracking
        
        $val=null;
        foreach($card as $c){
            $val=$c;
        }
        
        return view('card',['card'=>$c]);

    }
}
