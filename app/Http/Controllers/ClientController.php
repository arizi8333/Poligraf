<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class ClientController extends Controller
{
    // Admin function
    public function index(){
        return view('admin.users.client.index');
    }

    public function data(){
        $data = User::where('role_id', 'R03')->get();
        return response()->json(['data' => $data]);
    }

    public function create(Request $request){
        $tanggal = Carbon::now();

        $data1 = User::orderBy('id', 'DESC')->first(); 
        $id;

        if($data1 == null){
            $id = 'U000000001';
        }else {
            $newId = substr($data1->id, 1,9);
            $tambah = (int)$newId + 1;
            if (strlen($tambah) == 1){
                $id = "U00000000" .$tambah;
            }else if (strlen($tambah) == 2){
                $id = "U0000000" .$tambah;
            }else if (strlen($tambah) == 3){
                $id = "U000000" .$tambah;
            }else if (strlen($tambah) == 4){
                $id = "U00000" .$tambah;
            }else if (strlen($tambah) == 5){
                $id = "U0000" .$tambah;
            }else if (strlen($tambah) == 6){
                $id = "U000" .$tambah;
            }else if (strlen($tambah) == 7){
                $id = "U00" .$tambah;
            }else if (strlen($tambah) == 8){
                $id = "U0" .$tambah;
            }else if (strlen($tambah) == 9){
                $id = "U" .$tambah;
            }
        }

        User::create([
            'id' => $id,
            'role_id' => 'R03',
            'nama' => $request->nama,
            'companies' => $request->perusahaan,
            'no_hp' => $request->no_hp,
            'telp_perusahaan' => $request->telp,
            'address' => $request->alamat,
            'email' => $request->email,
            'email_verified_at' => $tanggal,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->to('/admin/client/index'); 
    }

    public function edit($id){
        $user = User::where('id',$id)->get();
        return $user->toJson();
    }

    public function update(Request $request, $id){
        if($request->password != null){
            User::where('id', $id)->update([
                'nama' => $request->nama,
                'companies' => $request->perusahaan,
                'no_hp' => $request->no_hp,
                'telp_perusahaan' => $request->telp,
                'address' => $request->alamat,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }else{
            User::where('id', $id)->update([
                'nama' => $request->nama,
                'companies' => $request->perusahaan,
                'no_hp' => $request->no_hp,
                'telp_perusahaan' => $request->telp,
                'address' => $request->alamat,
                'email' => $request->email
            ]);
        }

        return redirect()->to('/admin/client/index'); 
    }

    public function delete($id){
        User::where('id',$id)->delete();
    }

}
