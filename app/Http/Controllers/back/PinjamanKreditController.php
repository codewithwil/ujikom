<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\globalC;
use App\Models\Anggota;
use App\Models\Pengaturan;
use App\Models\PinjamanKredit;
use App\Models\Saldo;
use App\Models\SaldoKredit;
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
        $batasPinjamPersentase = Pengaturan::value('batas_pinjam');
        $saldoKoperasi = Saldo::selectRaw("SUM(saldo) AS value")->first();
        
        
        if ($saldoKoperasi) {
            $saldo = $saldoKoperasi->value;
            $batasPinjamAbsolut = $saldo * ($batasPinjamPersentase / 100);
        } else {
            // Handle jika saldo tidak tersedia
            $batasPinjamAbsolut = 0;
        }
        
        $batasPinjam = Pengaturan::value('batas_pinjam');
        return view('back.pinjaman.pinjaman-kredit.create',compact('jenisBayar','divisi','transaksi','anggota','statusBuku','keterangan',
        'saldoKoperasi', 'batasPinjamAbsolut'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['status'] = 1;

        DB::beginTransaction();
        try {
            $kode_pinjaman_kredit = autonumber('pinjaman_kredit', 'kode_pinjaman_kredit', 3, 'PJK');
            $data['kode_pinjaman_kredit'] = $kode_pinjaman_kredit;

            // Create pinjaman kredit entry
            $pinjamanKredit = PinjamanKredit::create($data);

            // Create saldo kredit entry
            $saldo = new SaldoKredit();
            $saldo->saldo = $data['nominal']; // Assuming nominal represents the loan amount
            $saldo->keterangan = $data['keterangan'];
            $saldo->save();

            DB::commit();
            return redirect(route('pinjamanKredit.index'))->with('success', 'Simpanan Debet has been created');
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
        return view('back.pinjaman.pinjaman-kredit.update',compact('pinjamK','jenisBayar','divisi','transaksi','anggota','statusBuku','keterangan'));
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
