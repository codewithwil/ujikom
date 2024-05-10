<?php

namespace App\Http\Controllers\back;

use App\{
    Http\Controllers\Controller,
    Models\SimpananKredit,
    Models\Anggota
};
use App\Http\Requests\SimpananK\CreateSimpananKRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(CreateSimpananKRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 1;
    
        DB::beginTransaction();
        try {
            SimpananKredit::create($data);
    
            DB::commit();
            return redirect(route('simpananKredit.index'))->with('success', ' Simpanan Kredit has been created');
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error while storing SimpananKredit: ' . $e->getMessage());

            info($e->getMessage());
            DB::rollBack();
    
            // Mengembalikan respons dengan status 422 dan pesan kesalahan yang sesuai
            return response()->json([
                "code"    => 422,
                "status"  => "Error",
                "message" =>  $e->getLine() . ' ' . $e->getMessage()
            ], 422);
        }
    }
    
}
