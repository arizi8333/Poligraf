<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diskon;

class DiskonController extends Controller
{
    public function index(){
        return view('admin.master.diskon.index');
    }

    public function data(){
        $data = Diskon::whereNotIn('id',['D0000'])->get();
        return response()->json(['data' => $data]);
    }

    public function create(Request $request){

        $data1 = Diskon::orderBy('id', 'DESC')->first(); 
        $id;

        if($data1 == null){
            $id = 'L0001';
        }else {
            $newId = substr($data1->id, 1,9);
            $tambah = (int)$newId + 1;
            if (strlen($tambah) == 1){
                $id = "D000" .$tambah;
            }else if (strlen($tambah) == 2){
                $id = "D00" .$tambah;
            }else if (strlen($tambah) == 3){
                $id = "D0" .$tambah;
            }else if (strlen($tambah) == 4){
                $id = "D" .$tambah;
            }
        }

        Diskon::create([
            'id' => $id,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
        ]);

        return redirect()->to('/admin/diskon/index'); 
    }

    public function edit($id){
        $Diskon = Diskon::where('id',$id)->get();
        return $Diskon->toJson();
    }

    public function update(Request $request, $id){
        Diskon::where('id', $id)->update([
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
        ]);

        return redirect()->to('/admin/diskon/index'); 
    }

    public function delete($id){
        Diskon::where('id',$id)->delete();
    }
}
