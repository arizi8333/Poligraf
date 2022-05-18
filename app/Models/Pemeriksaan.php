<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'pemeriksaans';

    public $timestamps = false;

    protected $fillable = [
        'id','pemesanan_id','layanan_id','user_id','case','nama_terperiksa','hasil','rating','riwayat_kesehatan','berkas_persetujuan',
    ];

    public function layanan(){
        return $this->belongsTo(Layanan::class,'layanan_id','id');
    }

    public function detaillayanan(){
        return $this->belongsTo(Detaillayanan::class,'layanan_id','layanan_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
