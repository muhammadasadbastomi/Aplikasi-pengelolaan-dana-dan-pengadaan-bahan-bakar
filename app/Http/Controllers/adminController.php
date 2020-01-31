<?php

namespace App\Http\Controllers;
use App\bidang;
use App\seksi;
use App\karyawan;
use App\kendaraan;
use App\item_kendaraan;
use App\kelengkapan;
use App\Pencairan;
use App\Rincian;
use App\Status_transmisi;
use Carbon\Carbon;
use PDF;
use HCrypt;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index(){

        return view('admin.index');
    }

    public function bidangIndex(){

        return view('admin.bidang.index');
    }

    public function seksiIndex(){

        return view('admin.seksi.index');
    }

    public function karyawanIndex(){

        return view('admin.karyawan.index');
    }

    public function kelengkapanKendaraanIndex(){

        return view('admin.kelengkapanKendaraan.index');
    }

    public function kendaraanIndex(){

        return view('admin.kendaraan.index');
    }

    public function itemKendaraanIndex(){
        
        return view('admin.itemKendaraan.index');
    }

    public function objekTransmisiIndex(){

        return view('admin.objekTransmisi.index');
    }

    public function statusTransmisiIndex(){

        return view('admin.statusTransmisi.index');
    }

    public function pencairanIndex(){

        return view('admin.pencairan.index');
    }

    public function pencairanAdd(Request $request){
        $pencairan = new pencairan;
        $pencairan->user_id = $request->user_id;
        $pencairan->keperluan = $request->keperluan;
        $pencairan->save();
        $pencairan_id = $pencairan->id;
        $uuid = HCrypt::encrypt($pencairan_id);
        $setuuid = pencairan::findOrFail($pencairan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();

        return view('admin.pencairan.add',compact('setuuid'));
    }

    public function pencairanDetail($uuid){
        $id = HCrypt::decrypt($uuid);
        $pencairan = pencairan::findOrFail($id);
        return view('admin.pencairan.detail',compact('pencairan'));
    }

    public function bidangCetak(){
        $bidang=bidang::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.bidangKeseluruhan', ['bidang'=>$bidang,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Bidang.pdf');
      }
    
    public function seksiCetak(){
        $seksi=seksi::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.seksiKeseluruhan', ['seksi'=>$seksi,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data seksi.pdf');
    }

    public function karyawanCetak(){
        $karyawan=karyawan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.karyawanKeseluruhan', ['karyawan'=>$karyawan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data karyawan.pdf');
    }

    public function kendaraanCetak(){
        $kendaraan=kendaraan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.kendaraanKeseluruhan', ['kendaraan'=>$kendaraan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Kendaraan.pdf');
    }

    public function itemKendaraanCetak(){
        $itemKendaraan=item_kendaraan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.itemKendaraanKeseluruhan', ['itemKendaraan'=>$itemKendaraan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Item Kendaraan.pdf');
    }

    public function kelengkapanKendaraanCetak(){
        $kelengkapan=kelengkapan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.kelengkapanKeseluruhan', ['kelengkapan'=>$kelengkapan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Kelengkapan.pdf');
    }

    public function statusTransmisiCetak(){
        $status=Status_transmisi::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.statusTransmisiKeseluruhan', ['status'=>$status,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data status transmisi.pdf');
    }

    public function pencairanCetak(){
        $pencairan = pencairan::all();
        $tgl       = Carbon::now()->format('d-m-Y');
        $pdf       =PDF::loadView('laporan.pencairanKeseluruhan', ['pencairan'=>$pencairan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data pencairan.pdf');
    }

    public function notaCetak($id){
        $pencairan=pencairan::findOrFail($id);
        $rincian=rincian::where('pencairan_id',$id)->get();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.notaCetak', ['pencairan'=>$pencairan,'rincian'=>$rincian,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan Nota.pdf');
      }

}
