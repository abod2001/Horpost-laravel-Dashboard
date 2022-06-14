<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Tower;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    //

    public function store(Request $request){

        $check = Flat::where('tower_id',$request->tower_id)->where('room',$request->room)->find();
        if($check){
           return back()->with('error','fdsfdsfds');
        }


    }
}
