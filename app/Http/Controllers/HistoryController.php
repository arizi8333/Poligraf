<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class HistoryController extends Controller
{
    public function index(){
        $id = auth()->user()->role_id;
        if($id == 'R03'){
            return view('client.history.index');
        }else{
            return view('admin.history.index');
        }
    }

    public function data(){
        $role_id = auth()->user()->role_id;
        $id = auth()->user()->id;
        if($role_id == 'R03'){
            $data = Pemesanan::where('user_id',$id)->where('status',3)->get();
            return response()->json(['data' => $data]);
        }else{
            $data = Pemesanan::where('status',3)->with('user')->get();
            return response()->json(['data' => $data]);
        }
    }
}
