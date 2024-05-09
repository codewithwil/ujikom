<?php

namespace App\Http\Controllers\back;

use App\{
    Http\Controllers\Controller,
    Models\SimpananKredit,
    Models\Anggota
};
use Illuminate\Http\Request;

class simpananKreditController extends Controller
{
    public function index(){
        $simpanK = SimpananKredit::with('Anggota')->get();
        return view('back.simpanan.simpanan-kredit.index', [
            'simpananK' => $simpanK
        ]);
    }

    public function create(){
        $jenisBayar = SimpananKredit::getJenisPembayaran();
        $divisi     = SimpananKredit::getDivisi();
        $anggota    = Anggota::get();
        $statusBuku = SimpananKredit::getStatusBuku();
        $keterangan = SimpananKredit::getKeterangan();
        return view('back.simpanan.simpanan-kredit.create', [
            'jenisBayar'  => $jenisBayar,
            'divisi'      => $divisi,
            'anggota'     => $anggota,  
            'statusBuku'     => $statusBuku,  
            'keterangan'     => $keterangan
        ]);
    }
}
