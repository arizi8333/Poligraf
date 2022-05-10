<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemesanan;
use App\Models\Pemeriksaan;
use App\Models\User;
use App\Models\Detaillayanan;
use Carbon\Carbon;

class PemeriksaanController extends Controller
{
    public function index(){
        return view('admin.pemeriksaan.index');
    }

    public function data(){
        $data = Pemesanan::where('status',2)->Orwhere('status',3)->with('user')->get();
        return response()->json(['data' => $data]);
    }

    public function edit($id){
        $decrypted_string = str_replace('_', '/', $id);
        $pemesanan = Detaillayanan::where('pemesanan_id',$decrypted_string)->with('pemesanan.user','pemesanan.diskon','layanan')->get();
        $pemeriksaan = Pemeriksaan::where('pemesanan_id',$decrypted_string)->with('layanan')->get();

        $data = Pemesanan::where('id',$decrypted_string)->first();
        // $user = User::where('role_id','R02')->get();
        $user = DB::table('pemeriksaans')
                    ->leftjoin('pemesanans','pemesanans.id','=','pemeriksaans.pemesanan_id')
                    ->select('pemeriksaans.user_id','pemeriksaans.pemesanan_id')
                    ->where('pemesanans.status',2)
                    ->where('pemesanans.tgl_selesai','>=',$data->tgl_mulai)
                    ->distinct()->get();
        
        $user_id = [];
        foreach($user as $u){
            array_push($user_id,[$u->user_id]);
        }
        if($user_id == null){
            $user = User::where('role_id','R02')->select('id','nama')->get();            
        }else{
            $user = User::where('role_id','R02')->whereNotIn('id',$user_id)->select('id','nama')->get();            
        }
        return view('admin.pemeriksaan.detail', compact('pemesanan','pemeriksaan','user'));
        // return json_encode([
        //     $user_id,$user
        // ]);
    }

    public function create(Request $request){
        // dd($request);
        $tahun = Carbon::now()->format('Y');
        $bulan = Carbon::now()->format('m');
        $tanggal = Carbon::now()->format('d');
        $awal = $tanggal.$bulan.$tahun;
        $tengah = ($tanggal+3) . ($bulan+6) . ($tahun+2);
        $layanan = Detaillayanan::where('pemesanan_id',$request->id)->get();
        foreach($layanan as $l){
            for($i=0; $i<$l->jumlah_terperiksa;$i++){
                $count = Pemeriksaan::count()+1;
                Pemeriksaan::create([
                    'id' => "$awal-$tengah-0{$count}",
                    'pemesanan_id'=>$l->pemesanan_id,
                    'layanan_id'=>$l->layanan_id,
                    'user_id'=>$request->instruktur,
                    'case'=>" ",
                    'nama_terperiksa'=>' ',
                    'hasil'=>"-",
                    'rating'=>0
                ]);
            }
        }
        return redirect()->to('/admin/pemeriksaan/index'); 
    }

    public function hasil($id){
        $file = Pemeriksaan::where('id',$id)->first();

        $path = storage_path('app/'. $file->hasil);
        
        return response()->file($path);
    }

    // Instruktur

    public function instruktur_index(){
        return view('instruktur.pemeriksaan.index');
    }

    public function instruktur_data(){
        $id = auth()->user()->id;
        $data = DB::table('pemesanans')
                    ->leftjoin('pemeriksaans','pemesanans.id','=','pemeriksaans.pemesanan_id')
                    ->leftjoin('users','users.id','=','pemesanans.user_id')
                    ->select('pemesanans.id as id','pemesanans.tgl_mulai as tgl_mulai','pemesanans.tgl_selesai as tgl_selesai','users.telp_perusahaan as telp','pemesanans.status as status','users.companies as companies')
                    ->where('pemesanans.status',2)
                    ->where('pemeriksaans.user_id',$id)
                    ->distinct()
                    ->get();
        
        return response()->json(['data' => $data]);
    }

    public function instruktur_edit($id){
        $role_id = auth()->user()->role_id;
        if($role_id == 'R03'){
            $decrypted_string = str_replace('_', '/', $id);
            $data = Detaillayanan::where('pemesanan_id',$decrypted_string)->with('pemesanan.user','pemesanan.diskon','layanan')->get();
            $data1 = Pemeriksaan::where('pemesanan_id',$decrypted_string)->with('layanan')->get();
            return view('client.history.detail',compact('data','data1'));
        }else{
            $decrypted_string = str_replace('_', '/', $id);
            $data = Detaillayanan::where('pemesanan_id',$decrypted_string)->with('pemesanan.user','pemesanan.diskon','layanan')->get();
            $data1 = Pemeriksaan::where('pemesanan_id',$decrypted_string)->with('layanan')->get();
            return view('instruktur.pemeriksaan.detail',compact('data','data1'));
        }
    }

    public function instruktur_update(Request $request){
        $file = $request->file('file');
        if ($file != null){
            if ($file->isValid()) {
                $path = $file->store('public/hasil');
                Pemeriksaan::where('id',$request->id)->update([
                    'nama_terperiksa' => $request->nama,
                    'case' => $request->case,
                    'hasil' => $path,
                ]);

                $data = Pemeriksaan::where('id',$request->id)->first();
                $decrypted_string = str_replace('/', '_', $data->pemesanan_id);
                
                return redirect()->to('/instruktur/pemeriksaan/edit/'.$decrypted_string); 
            }
        }
    }

    public function instruktur_konfirmasi($id){
        $decrypted_string = str_replace('_', '/', $id);
        Pemesanan::where('id',$decrypted_string)->update([
            'status' => 3
        ]);
        
    }
}
