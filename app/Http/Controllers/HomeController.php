<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemesanan;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('client.index');
    }

    public function profile()
    {
        return view('layouts.profile');
    }

    public function updateprofile(Request $request)
    {
        $id = auth()->user()->id;
        if($request->password != null || $request->password != " "){
            User::where('id', $id)->update([
                'nama' => $request->nama,
                'companies' => $request->companies,
                'no_hp' => $request->no_telp,
                'telp_perusahaan' => $request->telp,
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }else{
            User::where('id', $id)->update([
                'nama' => $request->nama,
                'companies' => $request->companies,
                'no_hp' => $request->no_hp,
                'telp_perusahaan' => $request->telp_perusahaan,
                'address' => $request->address,
                'email' => $request->email,
            ]);
        }
        
        return redirect()->to('/profile'); 
    }

    public function adminHome()
    {
        // $pendapatan = Pemesanan::where('status','3')->get();
        $user = User::where('role_id','R02')->count();
        $pemesanan = Pemesanan::where('status','1')->count();
        $layanan = Layanan::count();

        $pendapatan = DB::select(" select layanans.nama_layanan as layanan,count(detaillayanans.layanan_id) as total
                    from detaillayanans Left Join layanans On layanans.id = detaillayanans.layanan_id
                    Left Join pemesanans On pemesanans.id = detaillayanans.pemesanan_id 
                    where pemesanans.status = 3
                    group by layanan"
                    );
        return view('admin.index',compact('user','pemesanan','layanan','pendapatan'));
    }

    public function instrukturHome()
    {
        $id = auth()->user()->id;
        $data = DB::table('pemesanans')
                    ->leftjoin('pemeriksaans','pemesanans.id','=','pemeriksaans.pemesanan_id')
                    ->leftjoin('users','users.id','=','pemesanans.user_id')
                    ->select('pemesanans.id as id','pemesanans.tgl_mulai as tgl_mulai','pemesanans.tgl_selesai as tgl_selesai','users.telp_perusahaan as telp','pemesanans.status as status','users.companies as companies')
                    ->where('pemesanans.status',2)
                    ->where('pemeriksaans.user_id',$id)
                    ->distinct()
                    ->get();
        return view('instruktur.index', compact('data'));
    }

    public function notifikasi()
    {
        $role_id = auth()->user()->role_id;
        if($role_id == 'R01'){
            $data = Pemesanan::where('status',1)->get();
        }else if($role_id == 'R02'){
            $id = auth()->user()->id;
            $data = DB::table('pemesanans')
                    ->leftjoin('pemeriksaans','pemesanans.id','=','pemeriksaans.pemesanan_id')
                    ->leftjoin('users','users.id','=','pemesanans.user_id')
                    ->select('pemesanans.id as id','pemesanans.tgl_mulai as tgl_mulai','pemesanans.tgl_selesai as tgl_selesai','users.telp_perusahaan as telp','pemesanans.status as status','users.companies as companies')
                    ->where('pemesanans.status',2)
                    ->where('pemeriksaans.user_id',$id)
                    ->distinct()
                    ->get();
        }else if($role_id == 'R03'){
            $id = auth()->user()->id;
            $data = Pemesanan::where('user_id', $id)->where('status','!=',1)->where('status','!=',3)->get();
        }

        return json_encode([
            $data
        ]);
    }
}
