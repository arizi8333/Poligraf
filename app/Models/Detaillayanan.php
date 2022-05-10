<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detaillayanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'pemesanan_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'detaillayanans';

    public $timestamps = false;

    protected $fillable = [
        'pemesanan_id','layanan_id','jumlah_terperiksa'
    ];

    public function layanan(){
        return $this->belongsTo(Layanan::class,'layanan_id','id');
    }

    public function pemesanan(){
        return $this->belongsTo(Pemesanan::class,'pemesanan_id','id');
    }
}
