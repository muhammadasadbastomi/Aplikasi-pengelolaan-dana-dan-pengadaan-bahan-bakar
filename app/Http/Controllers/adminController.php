<?php

namespace App\Http\Controllers;
use App\bidang;
use App\seksi;
use App\karyawan;
use App\kendaraan;
use App\item_kendaraan;
use App\kelengkapan;
use Carbon\Carbon;
use PDF;
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

}
