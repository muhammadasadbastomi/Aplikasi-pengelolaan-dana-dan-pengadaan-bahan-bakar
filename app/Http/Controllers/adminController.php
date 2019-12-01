<?php

namespace App\Http\Controllers;

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

    public function kelengkapanKendaraanIndex(){

        return view('admin.kelengkapanKendaraan.index');
    }
}
