<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelDetailTransaksi extends Model
{
    protected $table = "detail_transaksi";
    public $timestamps = false;
    protected $fillable = [
        'id_transaksi', 'qty', 'subtotal', 'id_jeniscuci'
    ];
}
