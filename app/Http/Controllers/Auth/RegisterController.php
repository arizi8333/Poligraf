<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/client/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'perusahaan' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
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

        return User::create([
            'id' => $id,
            'role_id' => 'R03',
            'nama' => $data['nama'],
            'companies' => $data['perusahaan'],
            'no_hp' => $data['no_hp'],
            'telp_perusahaan' => $data['telp'],
            'address' => $data['address'],
            'email' => $data['email'],
            'email_verified_at' => $tanggal,
            'password' => Hash::make($data['password']),
        ]);
    }
}
