<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'pemesanans';

    public $timestamps = false;

    protected $fillable = [
        'id','user_id','diskon_id','bukti_pembayaran','status','total_harga'
        ,'jam_kadaluarsa','jam_pembayaran','keterangan','tgl_mulai','tgl_selesai',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function diskon(){
        return $this->belongsTo(Diskon::class,'diskon_id','id');
    }

    public function details(){
        return $this->hasMany(Detaillayanan::class);
    }
    
}
