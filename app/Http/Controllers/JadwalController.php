<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\User;
use App\Models\Detaillayanan;

class JadwalController extends Controller
{
    public function index(){
        $data = Pemesanan::where('status',2)->with('user','details.layanan')->get();
        return view('admin.jadwal.index', compact('data'));
    }

    public function checkjadwal($id){
        $user = User::where('role_id', 'R02')->count();
        $tanggal = Pemesanan::where('status',2)->where('tgl_mulai','<=',$id)->where('tgl_selesai','>=',$id)->count();
        return json_encode([
            $tanggal,
            $user
        ]);
    }
}
