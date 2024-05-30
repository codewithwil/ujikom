<?php

namespace App\Http\Controllers\back;

use App\{
    Http\Controllers\globalC,
    Models\Anggota,
    Models\SimpananDebet,
    Models\Saldo,
};
use Illuminate\{
    Http\Request,
    Support\Facades\DB
};
use Exception;

class SimpananDebetController extends globalC
{
    public function index(){
        $simpanD = SimpananDebet::with('Anggota')->where('status', 1)->get();
        return view('back.simpanan.simpanan-debet.index',[
            'simpanD' => $simpanD
        ]);
    }

    public function create(){
        $jenisBayar = SimpananDebet::getJenisPembayaran();
        $divisi     = SimpananDebet::getDivisi();
        $transaksi     = SimpananDebet::getTransaksi();
        $anggota    = Anggota::get();
        $statusBuku = SimpananDebet::getStatusBuku();
        $keterangan = SimpananDebet::getKeterangan();
        return view('back.simpanan.simpanan-debet.create', [
            'jenisBayar'  => $jenisBayar,
            'divisi'      => $divisi,
            'transaksi'      => $transaksi,
            'anggota'     => $anggota,  
            'statusBuku'     => $statusBuku,  
            'keterangan'     => $keterangan
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $anggota = Anggota::where('kode_anggota', $data['anggota_kode'])->first();
        $data['status'] = 1;
    
        DB::beginTransaction();
        try {

            $saldoKoperasi = new Saldo();
            $saldoKoperasi->saldo      = $data['pokok'] + $data['wajib'] + $data['sukarela'];
            if ($anggota) {
                $saldoKoperasi->keterangan = 'Anggota ' . $anggota->nama . ' telah melakukan ' . $data['transaksi'] . ' sebesar ' . ($data['pokok'] + $data['wajib'] + $data['sukarela']);
            } else {
                $saldoKoperasi->keterangan = 'Anggota tidak ditemukan';
            }
            
            
            $saldoKoperasi->save();
            SimpananDebet::create($data);

            DB::commit();
            return redirect(route('simpananDebet.index'))->with('success', ' Simpanan Debet has been created');
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error while storing simpanan Debet: ' . $e->getMessage());
    
            info($e->getMessage());
            DB::rollBack();

            return response()->json([
                "code"    => 422,
                "status"  => "Error",
                "message" =>  $e->getLine() . ' ' . $e->getMessage()
            ], 422);
        }
    }
    
    public function edit($kode_simpanan_debet){
        $jenisBayar = SimpananDebet::getJenisPembayaran();
        $divisi     = SimpananDebet::getDivisi();
        $transaksi  = SimpananDebet::getTransaksi();
        $anggota    = Anggota::get();
        $statusBuku = SimpananDebet::getStatusBuku();
        $keterangan = SimpananDebet::getKeterangan();
        return view('back.simpanan.simpanan-debet.update',[
            'simpanD'        => SimpananDebet::find($kode_simpanan_debet),
            'jenisBayar'     => $jenisBayar,
            'divisi'         => $divisi,
            'transaksi'      => $transaksi,
            'anggota'        => $anggota,  
            'statusBuku'     => $statusBuku,  
            'keterangan'     => $keterangan
        ]);
    }

    public function update(Request $request, $kode_simpanan_debet){
        $data = $request->all();
        
        DB::beginTransaction();
        try {
            $simpanK = SimpananDebet::find($kode_simpanan_debet);
            $simpanK->update($data);
            DB::commit();
            return redirect(route('simpananDebet.index'))->with('success', ' Simpanan Kredit has been created');
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error while storing SimpananDebet: ' . $e->getMessage());
    
            info($e->getMessage());
            DB::rollBack();
    
            return response()->json([
                "code"    => 422,
                "status"  => "Error",
                "message" =>  $e->getLine() . ' ' . $e->getMessage()
            ], 422);
        }
    }

    public function delete(Request $request){
        $validated = $request->validate([
            'kode_simpanan_debet' => 'required',
        ]);
    
        $name = SimpananDebet::where('kode_simpanan_debet', $validated['kode_simpanan_debet'])->first();
        if ($name) {
            $name->status = SimpananDebet::DELETED;
            $name->save();
            return response()->json(['message' => 'simpanan debet status updated successfully'], 200);
        }
        return response()->json(['message' => 'simpanan debet not found'], 404);
    }

}
