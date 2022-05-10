<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function index(){
        $id = auth()->user()->role_id;
        if($id == 'R03'){
            return view('client.layanan.index');
        }else{
            return view('admin.master.layanan.index');
        }
    }

    public function data(){
        $data = Layanan::get();
        return response()->json(['data' => $data]);
    }

    public function create(Request $request){

        $data1 = Layanan::orderBy('id', 'DESC')->first(); 
        $id;

        if($data1 == null){
            $id = 'L0001';
        }else {
            $newId = substr($data1->id, 1,9);
            $tambah = (int)$newId + 1;
            if (strlen($tambah) == 1){
                $id = "L000" .$tambah;
            }else if (strlen($tambah) == 2){
                $id = "L00" .$tambah;
            }else if (strlen($tambah) == 3){
                $id = "L0" .$tambah;
            }else if (strlen($tambah) == 4){
                $id = "L" .$tambah;
            }
        }

        Layanan::create([
            'id' => $id,
            'harga' => $request->harga,
            'nama_layanan' => $request->layanan,
        ]);

        return redirect()->to('/admin/layanan/index'); 
    }

    public function edit($id){
        $layanan = Layanan::where('id',$id)->get();
        return $layanan->toJson();
    }

    public function update(Request $request, $id){
        Layanan::where('id', $id)->update([
            'nama_layanan' => $request->layanan,
            'harga' => $request->harga,
        ]);

        return redirect()->to('/admin/layanan/index'); 
    }

    public function delete($id){
        Layanan::where('id',$id)->delete();
    }
}
