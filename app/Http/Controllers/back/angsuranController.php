<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\PinjamanDebet;
use App\Models\PinjamanKredit;
use Illuminate\Http\Request;

class angsuranController extends Controller
{
    public function debet(){
        $angsuranDebet = PinjamanDebet::with('Anggota')->where('status', 1)->get();
        return view('back.angsuran.angsuran-debet.index', [
            'angsuranDebet'  => $angsuranDebet
        ]);
    }

    public function debetDetail($kode_pinjaman_debet){
        return view('back.angsuran.angsuran-debet.show', [
            'angsuranDebet'  => PinjamanDebet::find($kode_pinjaman_debet)
        ]);
    }

    public function kredit(){
        $angsuranKredit = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        return view('back.angsuran.angsuran-kredit.index',[
            'angsuranKredit' => $angsuranKredit
        ]);
    }

    public function kreditDetail($kode_pinjaman_kredit){
        return view('back.angsuran.angsuran-kredit.show',[
            'angsuranKredit' => PinjamanKredit::find($kode_pinjaman_kredit)
        ]);
    }
}
