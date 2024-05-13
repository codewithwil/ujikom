<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\globalC;
use App\Models\Anggota;
use App\Models\PinjamanKredit;
use App\Models\Saldo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinjamanKreditController extends globalC
{
    public function index(){
        $pinjamK = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        return view('back.pinjaman.pinjaman-kredit.index',compact('pinjamK'));
    }

    public function create(){
        list($jenisBayar,$divisi,$transaksi,$anggota,$statusBuku,$keterangan) = self::getAttr();
        $saldoKoperasi = Saldo::selectRaw("SUM(saldo) AS value")->first();
        return view('back.pinjaman.pinjaman-kredit.create',compact('jenisBayar','divisi','transaksi','anggota','statusBuku','keterangan','saldoKoperasi'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['status'] = 1;
    
        DB::beginTransaction();
        try {
            $kode_pinjaman_kredit         = autonumber('pinjaman_kredit', 'kode_pinjaman_kredit', 3, 'PJK');
            $data['kode_pinjaman_kredit'] = $kode_pinjaman_kredit;
            PinjamanKredit::create($data);

            DB::commit();
            return redirect(route('pinjamanKredit.index'))->with('success', ' Simpanan Debet has been created');
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
    
    public function edit($kode_pinjaman_kredit){
        $pinjamK = PinjamanKredit::find($kode_pinjaman_kredit);
        list($jenisBayar,$divisi,$transaksi,$anggota,$statusBuku,$keterangan) = self::getAttr();
        return view('back.pinjaman.pinjaman-kredit.update',compact('jenisBayar','divisi','transaksi','anggota','statusBuku','keterangan'));
    }

    public function update(Request $request, $kode_pinjaman_kredit){
        $data = $request->all();
        
        DB::beginTransaction();
        try {
            $simpanK = PinjamanKredit::find($kode_pinjaman_kredit);
            $simpanK->update($data);
            DB::commit();
            return redirect(route('pinjamanKredit.index'))->with('success', ' Simpanan Kredit has been created');
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error while storing pinjamanKredit: ' . $e->getMessage());
    
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
            'kode_pinjaman_kredit' => 'required',
        ]);
    
        $name = PinjamanKredit::where('kode_pinjaman_kredit', $validated['kode_pinjaman_kredit'])->first();
        if ($name) {
            $name->status = PinjamanKredit::DELETED;
            $name->save();
            return $this->sendResponse("Processing Successfully");
        }
        return $this->sendError("Data Not Found", 404);
    }
}
