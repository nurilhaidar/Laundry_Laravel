<?php

namespace App\Http\Controllers;
use Validator;
use App\ModelDetailTransaksi;
use App\ModelJenisCuci;

use Illuminate\Http\Request;

class DetailTransaksi extends Controller
{
    public function register(Request $req){
        $val = Validator::make($req->all(),[
            'id_transaksi' => 'required',
            'id_jeniscuci' => 'required',
            'qty' => 'required',
        ]);

        if($val->fails()){
            return Response()->json($val->errors());
        }

        $sub = ModelJenisCuci::where('id_jeniscuci', $req->id_jeniscuci)->first();
        $subtotal = $req->qty * $sub->harga;

        $buat = ModelDetailTransaksi::create([
            'id_transaksi'=>$req->id_transaksi,
            'qty'=>$req->qty,
            'id_jeniscuci'=>$req->id_jeniscuci,
            'subtotal'=>$subtotal,
        ]);

        if($buat){
            return Response()->json(['Berhasil']);
        } else {
            return Response()->json(['Gagal']);
        }
    }

    public function edit($id, Request $req){
        $val = Validator::make($req->all(),[
            'id_transaksi' => 'required',
            'qty' => 'required',
            'id_jeniscuci' => 'required',
            'subtotal' => 'required',
        ]);

        if($val->fails()){
            return Response()->json($val->errors());
        }

        $edit = ModelDetailTransaksi::where('id_detailtransaksi', $id)->update([
            'id_transaksi'=>$req->id_transaksi,
            'qty'=>$req->qty,
            'id_jeniscuci'=>$req->id_jeniscuci,
            'subtotal'=>$req->subtotal,
        ]);
    }

    public function hapus($id){
        $hapus = ModelDetailTransaksi::where('id_detailtransaksi', $id)->delete();

        if($hapus){
            return Response()->json(['Berhasil']);
        } else {
            return Response()->json(['Gagal']);
        }
    }
}
