<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Models\PinjamanKredit;
use App\Models\SimpananDebet;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function simpanan(){
        $simpanan  = SimpananDebet::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-simpanan.index', compact('simpanan', 'pengaturan'));
    }

    public function pinjaman(){
        $pinjaman = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-pinjaman.index', compact('pinjaman', 'pengaturan'));
    }

    public function printSimpanan(){
        $simpanan  = SimpananDebet::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-simpanan.print', compact('simpanan', 'pengaturan'));
    }

    public function printPinjaman(){
        $pinjaman = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-pinjaman.print', compact('pinjaman', 'pengaturan'));
    }
}
