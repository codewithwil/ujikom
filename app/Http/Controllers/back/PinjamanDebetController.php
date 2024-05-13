<?php

namespace App\Http\Controllers\back;

use App\{
    Http\Controllers\globalC,
    Models\Anggota,
    Models\PinjamanDebet

};
use Illuminate\{
    Http\Request,
    Support\Facades\DB
};
use Exception;

class PinjamanDebetController extends globalC
{
    public function index(){
        $pinjamD = PinjamanDebet::with('Anggota')->where('status', 1)->get();
        return view('back.pinjaman.pinjaman-debet.index',compact('pinjamD'));
    }

    public function create(){
        list($jenisBayar,$divisi,$transaksi,$anggota,$statusBuku,$keterangan) = self::getAttr();
        
        return view('back.pinjaman.pinjaman-debet.create',compact('jenisayar','divisi','transaksi','anggota','statusBuku','keterangan'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['status'] = 1;
    
        DB::beginTransaction();
        try {
            $kode_pinjaman_debet            = autonumber('pinjaman_debet', 'kode_pinjaman_debet', 3, 'PJD');
            $data['kode_pinjaman_debet']    = $kode_pinjaman_debet;

            PinjamanDebet::create($data);

            DB::commit();
            return redirect(route('pinjamanDebet.index'))->with('success', ' Simpanan Debet has been created');
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
    
    public function edit($kode_pinjaman_debet){
        $pinjamanD = PinjamanDebet::find($kode_pinjaman_debet);
        list($jenisBayar,$divisi,$transaksi,$anggota,$statusBuku,$keterangan) = self::getAttr();
        
        return view('back.pinjaman.pinjaman-debet.update',compact('pinjamD','jenisBayar','divisi','transaksi','anggota','statusBuku','keterangan'));
    }

    public function update(Request $request, $kode_pinjaman_debet){
        $data = $request->all();
        
        DB::beginTransaction();
        try {
            $simpanK = PinjamanDebet::find($kode_pinjaman_debet);
            $simpanK->update($data);
            DB::commit();
            return redirect(route('pinjamanDebet.index'))->with('success', ' Simpanan debet has been created');
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error while storing pinjamanDebet: ' . $e->getMessage());
    
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
            'kode_pinjaman_debet' => 'required',
        ]);
    
        $name = PinjamanDebet::where('kode_pinjaman_debet', $validated['kode_pinjaman_debet'])->first();
        if ($name) {
            $name->status = PinjamanDebet::DELETED;
            $name->save();
            return $this->sendResponse("Process Successfully");
        }
        return $this->sendError("Data Not Found", 404);
    }

}
