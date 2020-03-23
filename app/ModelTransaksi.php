<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelTransaksi extends Model
{
    protected $table = "transaksi";
    public $timestamps = false;
    protected $fillable = [
        'id_pelanggan', 'id', 'tanggal_transaksi', 'tanggal_selesai',
    ];
}
