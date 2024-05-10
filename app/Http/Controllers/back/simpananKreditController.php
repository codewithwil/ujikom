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



    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['status'] = 1;
    
        DB::beginTransaction();
        try {
            $kode_simpanan_kredit = autonumber('simpanan_kredit', 'kode_simpanan_kredit', 3, 'SPK');
            $data['kode_simpanan_kredit'] = $kode_simpanan_kredit;
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
    
    public function edit($kode_simpanan_kredit){
        $jenisBayar = SimpananKredit::getJenisPembayaran();
        $divisi     = SimpananKredit::getDivisi();
        $anggota    = Anggota::get();
        $statusBuku = SimpananKredit::getStatusBuku();
        $keterangan = SimpananKredit::getKeterangan();
        return view('back.simpanan.simpanan-kredit.update',[
            'simpanK'   => SimpananKredit::find($kode_simpanan_kredit),
            'jenisBayar'  => $jenisBayar,
            'divisi'      => $divisi,
            'anggota'     => $anggota,  
            'statusBuku'     => $statusBuku,  
            'keterangan'     => $keterangan
        ]);
    }

    public function update(Request $request, $kode_simpanan_kredit){
        $data = $request->all();
        
        DB::beginTransaction();
        try {
            $simpanK = SimpananKredit::find($kode_simpanan_kredit);
            $simpanK->update($data);
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

    public function delete(Request $request){
        $validated = $request->validate([
            'kode_simpanan_kredit' => 'required',
        ]);
    
        $name = SimpananKredit::where('kode_simpanan_kredit', $validated['kode_simpanan_kredit'])->first();
        if ($name) {
            $name->status = SimpananKredit::DELETED;
            $name->save();
            return response()->json(['message' => 'simpanan kredit status updated successfully'], 200);
        }
        return response()->json(['message' => 'simpanan kredit not found'], 404);
    }
    
}
