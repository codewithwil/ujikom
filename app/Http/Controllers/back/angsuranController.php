<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\globalC;
use App\Models\PinjamanDebet;
use App\Models\PinjamanKredit;
use App\Models\SimpananDebet;
use Illuminate\Http\Request;

class angsuranController extends globalC
{
    public function debet(){
        $angsuranDebet = SimpananDebet::with('Anggota')->where('status', 1)->get();
        return view('back.angsuran.angsuran-debet.index',compact("angsuranDebet"));
    }

    public function debetDetail($kode_simpanan_debet){
        $angsuranDebet = SimpananDebet::find($kode_simpanan_debet);
        return view('back.angsuran.angsuran-debet.show', compact("angsuranDebet"));
    }

    public function kredit(){
        $angsuranKredit = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        return view('back.angsuran.angsuran-kredit.index',compact("angsuranKredit"));
    }

    public function kreditDetail($kode_pinjaman_kredit){
        $angsuranKredit = PinjamanKredit::find($kode_pinjaman_kredit);
        return view('back.angsuran.angsuran-kredit.show',compact("angsuranKredit"));
    }
}
