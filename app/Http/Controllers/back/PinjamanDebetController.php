<?php

namespace App\Http\Controllers\back;

use App\{
    Http\Controllers\Controller,
    Models\Anggota,
    Models\PinjamanDebet

};
use Illuminate\{
    Http\Request,
    Support\Facades\DB
};
use Exception;

class PinjamanDebetController extends Controller
{
    public function index(){
        $pinjamD = PinjamanDebet::with('Anggota')->where('status', 1)->get();
        return view('back.pinjaman.pinjaman-debet.index',[
            'pinjamD' => $pinjamD
        ]);
    }

    public function create(){
        $jenisBayar = PinjamanDebet::getJenisPembayaran();
        $divisi     = PinjamanDebet::getDivisi();
        $transaksi  = PinjamanDebet::getTransaksi();
        $anggota    = Anggota::get();
        $statusBuku = PinjamanDebet::getStatusBuku();
        $keterangan = PinjamanDebet::getKeterangan();
        return view('back.pinjaman.pinjaman-debet.create', [
            'jenisBayar'  => $jenisBayar,
            'divisi'      => $divisi,
            'transaksi'   => $transaksi,
            'anggota'     => $anggota,  
            'statusBuku'  => $statusBuku,  
            'keterangan'  => $keterangan
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['status'] = 1;
    
        DB::beginTransaction();
        try {
            $kode_simpanan_debet = autonumber('simpanan_debet', 'kode_simpanan_debet', 3, 'SPD');
            $data['kode_simpanan_debet'] = $kode_simpanan_debet;
            PinjamanDebet::create($data);
            DB::commit();
            return redirect(route('PinjamanDebet.index'))->with('success', ' Simpanan Debet has been created');
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error while storing pinjaman Debet: ' . $e->getMessage());
    
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
        $jenisBayar = PinjamanDebet::getJenisPembayaran();
        $divisi     = PinjamanDebet::getDivisi();
        $transaksi  = PinjamanDebet::getTransaksi();
        $anggota    = Anggota::get();
        $statusBuku = PinjamanDebet::getStatusBuku();
        $keterangan = PinjamanDebet::getKeterangan();
        return view('back.pinjaman.pinjaman-debet.update',[
            'pinjamD'        => PinjamanDebet::find($kode_simpanan_debet),
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
            $simpanK = PinjamanDebet::find($kode_simpanan_debet);
            $simpanK->update($data);
            DB::commit();
            return redirect(route('PinjamanDebet.index'))->with('success', ' Simpanan Kredit has been created');
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error while storing PinjamanDebet: ' . $e->getMessage());
    
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
    
        $name = PinjamanDebet::where('kode_simpanan_debet', $validated['kode_simpanan_debet'])->first();
        if ($name) {
            $name->status = PinjamanDebet::DELETED;
            $name->save();
            return response()->json(['message' => 'pinjaman debet status updated successfully'], 200);
        }
        return response()->json(['message' => 'pinjaman debet not found'], 404);
    }

}
