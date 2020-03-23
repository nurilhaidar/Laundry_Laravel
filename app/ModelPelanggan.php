<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelPelanggan extends Model
{
    protected $table = "pelanggan";
    public $timestamps = false;
    protected $fillable = [
        'nama_pelanggan', 'alamat', 'telp'
    ];
}
