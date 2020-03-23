<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\ModelPelanggan;

class Pelanggan extends Controller
{
    public function register(Request $req){
        $val = Validator::make($req->all(),[
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
        ]);

        if($val->fails()){
            return Response()->json($val->errors());
        }

        $buat = ModelPelanggan::create([
            'nama_pelanggan'=>$req->nama_pelanggan,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
        ]);

        if($buat){
            return Response()->json(['Berhasil']);
        } else {
            return Response()->json(['Gagal']);
        }
    }

    public function edit($id, Request $req){
        $val = Validator::make($req->all(),[
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
        ]);

        if($val->fails()){
            return Response()->json($val->errors());
        }

        $edit = ModelPelanggan::where('id_jeniscuci', $id)->update([
            'nama_pelanggan'=>$req->nama_pelanggan,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
        ]);
    }

    public function hapus($id){
        $hapus = ModelPelanggan::where('id_pelanggan', $id)->delete();

        if($hapus){
            return Response()->json(['Berhasil']);
        } else {
            return Response()->json(['Gagal']);
        }
    }
}
