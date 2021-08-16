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
        
        $card=Cards::get()->where('id',Cards::max('id')); //returns Eloquent\Collection with relationship tracking
        
        $val=null;
        foreach($card as $c){
            $val=$c;
        }
        
        return view('card',['card'=>$c]);

    }

    public function moveCard(Request $request){
        $card_id=$request->card_id;
        $dir=$request->dir;

        if($dir==="up"){
            //get this cards row number
            $card=Cards::where('id',$card_id)->first();
            $row_number=$card->row_number;
            $column_id=$card->column_id;

           //get up card data
         
           $up_card=Cards::whereRaw('row_number < ? and column_id = ?',[$row_number,$column_id])->orderBy('row_number','desc')->first();
     
           if($up_card){
            $up_card_id=$up_card->id;
            $up_card_row_number=$up_card->row_number;
 
            //now swap rows  bewteen current card and up card
            Cards::where('id',$card_id)->update(['row_number'=>$up_card_row_number]);
 
            Cards::where('id',$up_card_id)->update(['row_number'=>$row_number]);
 
           return "success";

           }
           else{
               return "error";
           }

        }
        elseif($dir==="down"){
            //get this cards row number
            $card=Cards::where('id',$card_id)->first();
            $row_number=$card->row_number;
            $column_id=$card->column_id;

           //get down card data
          
           $up_card=Cards::whereRaw('row_number > ? and column_id = ?',[$row_number,$column_id])->orderBy('row_number','asc')->first();
     
           if($up_card){
            $up_card_id=$up_card->id;
            $up_card_row_number=$up_card->row_number;
 
            //now swap rows  bewteen current card and up card
            Cards::where('id',$card_id)->update(['row_number'=>$up_card_row_number]);
 
            Cards::where('id',$up_card_id)->update(['row_number'=>$row_number]);
 
           return "success";

           }
           else{
               return "error";
           }

        }
        elseif($dir==="right"){
            //get this cards row number
            $card=Cards::where('id',$card_id)->first();
            $row_number=$card->row_number;
            $column_id=$card->column_id;
          
           $next_col=Columns::where('id','>',$column_id)->first();
           $new_row_number=Cards::max('row_number')+1;
           $new_column_id=$next_col->id;

           if($next_col){
 
            Cards::where('id',$card_id)->update(['row_number'=>$new_row_number,'column_id'=>$new_column_id,]);
 
           return "success";

           }
           else{
               return "error";
           }

        }
        elseif($dir==="left"){
            //get this cards row number
            $card=Cards::where('id',$card_id)->first();
            $row_number=$card->row_number;
            $column_id=$card->column_id;
          
           $prev_col=Columns::where('id','<',$column_id)->orderBy('id','desc')->first();
           $new_row_number=Cards::max('row_number')+1;
           $new_column_id=$prev_col->id;

           if($prev_col){
 
            Cards::where('id',$card_id)->update(['row_number'=>$new_row_number,'column_id'=>$new_column_id,]);
 
           return "success";

           }
           else{
               return "error";
           }

        }

    }
        
        public function deleteColumn(Request $request){
$col_id=$request->col;
Columns::where('id',$col_id)->delete();
return "success";
        }
        public function editCard(Request $request){
            $card_id=$request->card_id;
            $title=$request->title;
            $desc=$request->desc;

            Cards::where('id',$card_id)->update(['title'=>$title,'description'=>$desc]);
            return "success";

                    }
       

}
