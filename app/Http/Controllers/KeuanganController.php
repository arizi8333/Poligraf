<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index(){
        return view('admin.keuangan.index');
    }

    public function data($id, $id1){
        $data = Pemesanan::where('status',3)->whereMonth('tgl_mulai',$id1)->whereYear('tgl_selesai', $id)->get();
        return json_encode([
            $data
        ]);
    }

    public function grapik($id){
        if($id == 0){
            $data =  DB::select(" select layanans.nama_layanan as layanan,count(detaillayanans.layanan_id) as total
                from detaillayanans Left Join layanans On layanans.id = detaillayanans.layanan_id
                Left Join pemesanans On pemesanans.id = detaillayanans.pemesanan_id 
                
                group by layanan"
                );
        }else{
            $data =  DB::select(" select layanans.nama_layanan as layanan,count(detaillayanans.layanan_id) as total
                from detaillayanans Left Join layanans On layanans.id = detaillayanans.layanan_id
                Left Join pemesanans On pemesanans.id = detaillayanans.pemesanan_id 
                where year(pemesanans.tgl_mulai) = '$id'
                group by layanan"
                );
        }
        
        return json_encode([
            $data
        ]);
    }
}
