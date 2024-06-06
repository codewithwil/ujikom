<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\globalC;
use App\Models\Anggota;
use App\Models\BagiHasil;
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
        $bagiHasil = BagiHasil::get();
        $batasPinjamPersentase = Pengaturan::value('batas_pinjam');
        $saldoKoperasi = Saldo::selectRaw("SUM(saldo) AS value")
            ->whereRaw("keterangan LIKE '%kas%'")
            ->first();
        
        if ($saldoKoperasi) {
            $saldo = $saldoKoperasi->value;
            $batasPinjamAbsolut = $saldo * ($batasPinjamPersentase / 100);
        } else {
            // Handle jika saldo tidak tersedia
            $batasPinjamAbsolut = 0;
        }
        
        // Menggunakan nilai persentase yang sama yang sudah dihitung sebelumnya
        $batasPinjam = $batasPinjamPersentase;
        
        return view('back.pinjaman.pinjaman-kredit.create',compact('jenisBayar','divisi','transaksi','anggota','statusBuku','keterangan',
        'saldoKoperasi', 'batasPinjamAbsolut', 'bagiHasil'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['status'] = 1;
        $data['transaksi'] = 'pinjaman anggota';
        $anggota = Anggota::where('kode_anggota', $data['anggota_kode'])->first();
        DB::beginTransaction();
        try {

            // Create saldo kredit entry
            $saldo = new Saldo();
            $saldo->saldo = $data['nominal']; // Assuming nominal represents the loan amount
            if ($anggota) {
                $saldo->keterangan = 'Anggota ' . $anggota->nama . ' telah melakukan ' . $data['transaksi'] . ' sebesar ' .$data['nominal'];
            } else {
                $saldo->keterangan = 'Anggota tidak ditemukan'; 
            }
            $saldo->save();
            PinjamanKredit::create($data);
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
        $batasPinjamPersentase = Pengaturan::value('batas_pinjam');
        $saldoKoperasi = Saldo::selectRaw("SUM(saldo) AS value")->first();
        $bagiHasil = BagiHasil::get();
        
        if ($saldoKoperasi) {
            $saldo = $saldoKoperasi->value;
            $batasPinjamAbsolut = $saldo * ($batasPinjamPersentase / 100);
        } else {
            // Handle jika saldo tidak tersedia
            $batasPinjamAbsolut = 0;
        }
        return view('back.pinjaman.pinjaman-kredit.update',compact('pinjamK','jenisBayar','divisi','transaksi',
        'anggota','statusBuku','keterangan',  'saldoKoperasi', 'batasPinjamAbsolut', 'bagiHasil'));
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
