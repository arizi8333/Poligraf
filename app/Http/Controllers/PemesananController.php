<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Detaillayanan;
use App\Models\User;
use App\Models\Layanan;
use App\Models\Diskon;
use Carbon\Carbon;
use PDF;

class PemesananController extends Controller
{
    public function index(){
        $data = Pemesanan::where('status',1)->where('bukti_pembayaran',null)->get();
        
        foreach($data as $d){
            $time = Carbon::now();
            $time->format('H:i:s');
            if($d->jam_kadaluarsa > $time){
                Pemesanan::where('id',$d->id)->delete();
            }
        }
        
        $id = auth()->user()->role_id;
        if($id == 'R03'){
            return view('client.pemesanan.index');
        }else{
            return view('admin.pemesanan.index');
        }
    }

    public function data(){

        $role_id = auth()->user()->role_id;
        $id = auth()->user()->id;
        if($role_id == 'R03'){
            $data = Pemesanan::where('user_id',$id)->whereNotIn('status',[3])->get();
            return response()->json(['data' => $data]);
        }else{
            $data = Pemesanan::whereNotIn('status',[3])->with('user')->get();
            return response()->json(['data' => $data]);
        }
    }

    public function create(){
        $data = Pemesanan::where('status',1)->where('bukti_pembayaran',null)->get();
        
        foreach($data as $d){
            $time = Carbon::now();
            $time->format('H:i:s');
            if($d->jam_kadaluarsa > $time){
                Pemesanan::where('id',$d->id)->delete();
            }
        }

        $id = auth()->user()->role_id;
        if($id == 'R03'){
            $diskons = Diskon::whereNotIn('id',['D0000'])->where('status', 1)->first();
            if($diskons == null){
                $diskons = Diskon::where('id','D0000')->first();
            }
            $jadwal = Pemesanan::where('status',2)->with('user')->get(); 
            $layanan = Layanan::get(); 
            $total = Layanan::count(); 
            return view('client.pemesanan.create', compact('diskons', 'jadwal','layanan','total'));
        }else{
            $users = User::where('role_id', 'R03')->get();
            $diskons = Diskon::whereNotIn('id',['D0000'])->where('status', 1)->get();
            $jadwal = Pemesanan::where('status',2)->with('user')->get(); 
            $layanan = Layanan::get(); 
            $total = Layanan::count(); 
            return view('admin.pemesanan.create', compact('users', 'diskons', 'jadwal','layanan','total'));
        }
    }

    public function store(Request $request){

        function getRomawi($bln){
            switch ($bln){
                case 1: 
                    return "I";
                    break;
                case 2:
                    return "II";
                    break;
                case 3:
                    return "III";
                    break;
                case 4:
                    return "IV";
                    break;
                case 5:
                    return "V";
                    break;
                case 6:
                    return "VI";
                    break;
                case 7:
                    return "VII";
                    break;
                case 8:
                    return "VIII";
                    break;
                case 9:
                    return "IX";
                    break;
                case 10:
                    return "X";
                    break;
                case 11:
                    return "XI";
                    break;
                case 12:
                    return "XII";
                    break;
            }
        }

        $data1 = Pemesanan::orderBy('id', 'DESC')->first(); 
        $id;

        $tahun = Carbon::now()->format('Y');
        $bulan = Carbon::now()->format('m');

        $time = Carbon::now();

        $bulan_romawi = getRomawi($bulan);
        if($data1 == null){
            $id = '001/PI-QT/'. $bulan_romawi . '/' . $tahun;
        }else {
            $newId = substr($data1->id, 1,3);
            $tambah = (int)$newId + 1;
            if (strlen($tambah) == 1){
                $id = "00".$tambah. "/PI-QT/". $bulan_romawi . '/' . $tahun;
            }else if (strlen($tambah) == 2){
                $id = "0".$tambah. "/PI-QT/". $bulan_romawi . '/' . $tahun;
            }else if (strlen($tambah) == 3){
                $id = $tambah. "/PI-QT/". $bulan_romawi . '/' . $tahun;
            }
        }
        
        $diskon = Diskon::where('id', $request->diskon)->first();
        $diskon = $diskon->jumlah;

        // var_dump($time);
        Pemesanan::create([
            'id' => $id,
            'user_id' => $request->client,
            'diskon_id' => $request->diskon,
            'bukti_pembayaran' => null,
            'status' => 1,
            'total_harga' => 0,
            'jam_kadaluarsa' => $time->addHours(2)->format('H:i:s'),
            'jam_pembayaran' => 0,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'keterangan' => null,
        ]);

        $harga_total = 0;
        $count = count($request->total);
        for ($a = 0; $a < $count; $a++){
            if($request->total[$a] != null || $request->total[$a] != 0){
                $harga_layanan = Layanan::where('id', $request->layanan[$a])->first();
                $harga = $request->total[$a] * $harga_layanan->harga;
                $harga_total = $harga_total + $harga;

                Detaillayanan::create([
                    'pemesanan_id' => $id,
                    'layanan_id' => $request->layanan[$a],
                    'jumlah_terperiksa' => $request->total[$a],
                ]);
            }
        }

        Pemesanan::where('id', $id)->update([
            'total_harga' => $harga_total - ($harga_total * $diskon / 100),
        ]);

        // var_dump($count);
        $id = auth()->user()->role_id;
        if($id == 'R03'){
            return redirect()->to('/client/pemesanan/index'); 
        }else{
            return redirect()->to('/admin/pemesanan/index'); 
        }
    }

    public function edit($id){
        $decrypted_string = str_replace('_', '/', $id);
        $pemesanan = Detaillayanan::where('pemesanan_id',$decrypted_string)->with('pemesanan.user','pemesanan.diskon','layanan')->get();
        $id_role = auth()->user()->role_id;
        if($id_role == 'R03'){
            return view('client.pemesanan.detail', compact('pemesanan'));
        }else{
            return view('admin.pemesanan.detail', compact('pemesanan'));
        }
    }

    public function update(Request $request, $id){
        $decrypted_string = str_replace('_', '/', $id);
        $id_role = auth()->user()->role_id;
        
        if($id_role == 'R03'){
            $file = $request->file('file');
            if ($file != null){
                if ($file->isValid()) {
                    $path = $file->store('public/bukti');
                    Pemesanan::where('id', $decrypted_string)->update([
                        'bukti_pembayaran' => $path,
                        'jam_pembayaran' => $request->jam_pembayaran,
                    ]);
                }
                return redirect()->to('/client/pemesanan/edit/'.$id); 
            }
        }else{
            if($request->jam_pembayaran != null){
                $file = $request->file('file');
                if ($file != null){
                    if ($file->isValid()) {
                        $path = $file->store('public/bukti');
                        Pemesanan::where('id', $decrypted_string)->update([
                            'bukti_pembayaran' => $path,
                            'jam_pembayaran' => $request->jam_pembayaran,
                            'status' => $request->status,
                            'keterangan' => $request->keterangan,
                        ]);
                    }
                }
            }else{
                Pemesanan::where('id', $decrypted_string)->update([
                    'status' => $request->status,
                    'keterangan' => $request->keterangan,
                ]);
            }

            return redirect()->to('/admin/pemesanan/edit/'.$id); 
        }
    }

    public function delete($id){
        $decrypted_string = str_replace('_', '/', $id);
        Pemesanan::where('id',$decrypted_string)->delete();
    }

    public function bukti($id){
        $decrypted_string = str_replace('_', '/', $id);
        $file = Pemesanan::where('id',$decrypted_string)->first();

        $path = storage_path('app/'. $file->bukti_pembayaran);
        
        return response()->file($path);
    }

    public function invoice($id){
        $decrypted_string = str_replace('_', '/', $id);
        $data = Detaillayanan::where('pemesanan_id',$decrypted_string)->with('pemesanan.user','layanan')->get();
        
        // return view('cetak_rkk', compact('datas','kewenangan'));
        $pdf = PDF::loadView('admin.cetak.invoice', compact('data'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }

    public function quotation($id){
        $decrypted_string = str_replace('_', '/', $id);
        $data = Detaillayanan::where('pemesanan_id',$decrypted_string)->with('pemesanan.user','layanan')->get();
        
        // return view('cetak_rkk', compact('datas','kewenangan'));
        $pdf = PDF::loadView('admin.cetak.quotation', compact('data'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }

    public function kuitansi($id){
        $decrypted_string = str_replace('_', '/', $id);
        $data = Detaillayanan::where('pemesanan_id',$decrypted_string)->with('pemesanan.user','layanan')->get();
        
        // return view('cetak_rkk', compact('datas','kewenangan'));
        $pdf = PDF::loadView('admin.cetak.kuitansi', compact('data'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }
}
