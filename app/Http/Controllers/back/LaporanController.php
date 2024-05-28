<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\PinjamanKredit;
use App\Models\SimpananDebet;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function simpanan(){
        $simpanan  = SimpananDebet::with('Anggota')->where('status', 1)->get();
        return view('back.laporan.laporan-simpanan.index', compact('simpanan'));
    }

    public function pinjaman(){
        $pinjaman = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        return view('back.laporan.laporan-pinjaman.index', compact('pinjaman'));
    }
}
