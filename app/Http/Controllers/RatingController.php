<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function index(){
        $role_id = auth()->user()->role_id;
        $id = auth()->user()->id;
        if($role_id == "R02"){
        $datas = DB::table('pemesanans')
                    ->leftjoin('pemeriksaans','pemesanans.id','=','pemeriksaans.pemesanan_id')
                    ->leftjoin('users','users.id','=','pemesanans.user_id')
                    ->select('pemeriksaans.rating as rating','pemesanans.id as id','users.companies as perusahaan','pemesanans.tgl_mulai as tgl_mulai','pemesanans.tgl_selesai as tgl_selesai','pemeriksaans.rating as rating')
                    ->where('pemesanans.status',3)
                    ->where('pemeriksaans.user_id',$id)
                    // ->groupby('nama')
                    ->distinct()->get();
            return view('instruktur.rating.index', compact('datas'));
        }else{
            return view('admin.rating.index');
        }
    }

    public function data($id, $id1){
        $role_id = auth()->user()->id;
        // $data = DB::table('pemesanans')
        //             ->leftjoin('pemeriksaans','pemesanans.id','=','pemeriksaans.pemesanan_id')
        //             ->leftjoin('users','users.id','=','pemeriksaans.user_id')
        //             ->select('users.nama as nama','pemeriksaans.rating as rating')
        //             ->whereMonth('pemesanans.tgl_mulai',$id1)->whereYear('pemesanans.tgl_selesai', $id)
        //             ->where('pemesanans.status',3)
        //             // ->where('pemeriksaans.user_id',$role_id)
        //             // ->groupby('nama')
        //             ->distinct()->get();
        $data1 = DB::select(" select nama, email, ROUND(avg(rating),1) as rating, count(rating) as total
        from
            ( select distinct users.nama as nama, users.email as email, pemeriksaans.rating as rating 
            from pemesanans Left Join pemeriksaans On pemesanans.id = pemeriksaans.pemesanan_id
            Left Join users On users.id = pemeriksaans.user_id
            where pemesanans.status = 3 and month(pemesanans.tgl_mulai) = $id1 AND year(pemesanans.tgl_mulai) = $id
            ) dt
            group by nama, email"
        );

        return json_encode([
            $data1
        ]);
    }

    public function instruktur_index(){
        return view('admin.users.instruktur.index');
    }

    public function client_rating(Request $request){
        $data = Pemeriksaan::where('pemesanan_id',$request->id)->get();
        foreach($data as $d){
            Pemeriksaan::where('id',$d->id)->update([
                'rating' => $request->rating,
            ]);
        }
        
        $decrypted_string = str_replace('/', '_', $request->id);
        return redirect()->to('client/history/edit/'.$decrypted_string);
    }
}
