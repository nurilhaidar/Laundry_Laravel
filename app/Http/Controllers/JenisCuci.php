<?php

namespace App\Http\Controllers;
use Validator;
use App\ModelJenisCuci;

use Illuminate\Http\Request;

class JenisCuci extends Controller
{
    public function register(Request $req){
        $val = Validator::make($req->all(),[
            'nama_jeniscuci' => 'required',
            'harga' => 'required',
        ]);

        if($val->fails()){
            return Response()->json($val->errors());
        }

        $buat = ModelJenisCuci::create([
            'nama_jeniscuci'=>$req->nama_jeniscuci,
            'harga'=>$req->harga,
        ]);

        if($buat){
            return Response()->json(['Berhasil']);
        } else {
            return Response()->json(['Gagal']);
        }
    }

    public function edit($id, Request $req){
        $val = Validator::make($req->all(),[
            'nama_jenis' => 'required',
            'harga' => 'required',
        ]);

        if($val->fails()){
            return Response()->json($val->errors());
        }

        $edit = ModelJenisCuci::where('id_jeniscuci', $id)->update([
            'nama_jenis'=>$req->nama_jenis,
            'harga'=>$req->harga,
        ]);

        if($edit){
            return Response()->json(['Berhasil']);
        } else {
            return Response()->json(['Gagal']);
        }
    }

    public function hapus($id){
        $hapus = ModelJenisCuci::where('id_pelanggan', $id)->delete();

        if($hapus){
            return Response()->json(['Berhasil']);
        } else {
            return Response()->json(['Gagal']);
        }
    }
}
