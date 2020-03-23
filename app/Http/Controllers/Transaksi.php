<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\ModelTransaksi;

class Transaksi extends Controller
{
    public function register(Request $req){
        $val = Validator::make($req->all(),[
            'id_pelanggan' => 'required',
            'id' => 'required',
            'tanggal_transaksi' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        if($val->fails()){
            return Response()->json($val->errors());
        }

        $buat = ModelTransaksi::create([
            'id_pelanggan'=>$req->id_pelanggan,
            'id'=>$req->id,
            'tanggal_transaksi'=>$req->tanggal_transaksi,
            'tanggal_selesai'=>$req->tanggal_selesai,
        ]);

        if($buat){
            return Response()->json(['Berhasil']);
        } else {
            return Response()->json(['Gagal']);
        }
    }

    public function edit($id, Request $req){
        $val = Validator::make($req->all(),[
            'id_pelanggan' => 'required',
            'id' => 'required',
            'tanggal_transaksi' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        if($val->fails()){
            return Response()->json($val->errors());
        }

        $edit = ModelTransaksi::where('id_transaksi', $id)->update([
            'id_pelanggan'=>$req->id_pelanggan,
            'id'=>$req->id,
            'tanggal_transaksi'=>$req->tanggal_transaksi,
            'tanggal_selesai'=>$req->tanggal_selesai,
        ]);
    }

    public function hapus($id){
        $hapus = ModelTransaksi::where('id_transaksi', $id)->delete();

        if($hapus){
            return Response()->json(['Berhasil']);
        } else {
            return Response()->json(['Gagal']);
        }
    }

    public function tampil(Request $req){
        $transaksi = DB::table('transaksi')->join('pelanggan', 'pelanggan.id_pelanggan','=', 'transaksi.id_pelanggan')
        ->where('transaksi.tanggal_transaksi','>=',$req->tanggal_transaksi)
        ->where('transaksi.tanggal_transaksi','<=',$req->tanggal_selesai)
        ->select('nama_pelanggan','telp','alamat','transaksi.id_transaksi','tanggal_transaksi','tanggal_selesai')
        ->get();

        if($transaksi->count() > 0){
            $data_transaksi = array();
            foreach ($transaksi as $t){
                $grand = DB::table('detail_transaksi')->where('id_transaksi','=',$t->id_transaksi)
                ->groupBy('id_transaksi')
                ->select(DB::raw('sum(subtotal) as grandtotal'))
                ->first();

                $detail = DB::table('detail_transaksi')->join('jenis_cuci','detail_transaksi.id_jeniscuci','=','jenis_cuci.id_jeniscuci')
                    ->where('id_transaksi','=',$t->id_transaksi)
                    ->get();

                    $data_transaksi[] = array(
                        'Tanggal' => $t->tanggal_transaksi,
                        'Nama Pelanggan' => $t->nama_pelanggan,
                        'Alamat' => $t->alamat,
                        'No Telp' => $t->telp,
                        'Deadline' => $t->tanggal_selesai,
                        'Grand Total' => $grand, 
                        'Detail' => $detail,
                    );
                }
                
                return response()->json(compact('data_transaksi'));
                } else{
                $status = 'tidak ada transaksi antara tanggal '.$req->tanggal_transaksi.' sampai dengan tanggal '.$req->tanggal_selesai;
                return response()->json(compact('status'));
            }
        }
}
