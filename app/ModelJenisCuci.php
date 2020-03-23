<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelJenisCuci extends Model
{
    protected $table = 'jenis_cuci';
    public $timestamps = false;
    protected $fillable = [
        'nama_jeniscuci', 'harga'
    ];
}
