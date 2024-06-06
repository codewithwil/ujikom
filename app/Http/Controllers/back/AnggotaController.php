<?php

namespace App\Http\Controllers\back;

use App\{
    Models\Anggota,
    Http\Controllers\globalC,
    Http\Requests\anggota\CreateAnggotaRequest
};
use App\Http\Requests\anggota\UpdateAnggotaRequest;
use App\Models\JenisSimpanan;
use App\Models\Keterangan;
use App\Models\Saldo;
use App\Models\SimpananDebet;
use Illuminate\{
    Http\Request,
    Support\Facades\DB
};
use Exception;
use Illuminate\Support\Facades\Log;

class AnggotaController extends globalC
{
    public function index(){
        $anggota = Anggota::where('status', Anggota::ACTIVE)->get();
        return view('back.anggota.index', compact("anggota"));
    }

    public function create(){
        $jenis = JenisSimpanan::get();
        return view('back.anggota.create',[
            'jenis' => $jenis
        ]);
    }
  
        public function store(Request $request){
            $data = $request->all();
            $data['status'] = 1;
            $props = $data['props'];
            if(is_array($props) && !empty($props)) {
                // Periksa apakah semua nilai dalam array adalah numerik
                if (array_filter($props, 'is_numeric') === $props) {
                    $totalProps = array_sum($props);
                } else {
                    // Atur $totalProps ke 0 atau nilai default yang sesuai
                    $totalProps = 0;
                }
            } else {
                // Atur $totalProps ke 0 atau nilai default yang sesuai
                $totalProps = 0;
            }
        
            DB::beginTransaction();
            try {
                $anggota = new Anggota();
                $anggota->kode_anggota = $data['kode_anggota'];
                $anggota->nik          = $data['nik'];
                $anggota->nama         = $data['nama'];
                $anggota->alamat       = $data['alamat'];
                $anggota->email        = $data['email'];
                $anggota->telepon      = $data['telepon'];
                $anggota['status']     = 1;
                $anggota->save();
        
                $simpananDebet = new SimpananDebet();
                $simpananDebet->kode_simpanan_debet = $data['kode_simpanan_debet'];
                $simpananDebet->anggota_kode        = $data['kode_anggota'];
                $simpananDebet->tanggal             = $data['tanggal'];
                $simpananDebet->jenis_pembayaran    = $data['jenis_pembayaran'];
                $simpananDebet->transaksi           = 'kas';
                $simpananDebet->divisi              = $data['divisi'];
                $simpananDebet->props               = json_encode($props);
                $simpananDebet->keterangan          = $data['keterangan'];
                $simpananDebet->status_buku         = $data['status_buku'];
                $simpananDebet['status']            = 1;
                $simpananDebet->save();

                $saldoKoperasi = new Saldo();
                $saldoKoperasi->saldo      = $totalProps;
                $saldoKoperasi->keterangan = $data['keterangan'];
                $saldoKoperasi->save();
                DB::commit();
                return redirect(route('anggota.index'))->with('success', ' Anggota has been created');
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                info($errorMessage); // Log pesan kesalahan ke dalam log biasa
                Log::error('Error while storing data: ' . $errorMessage); // Catat pesan kesalahan ke dalam log error
            
                DB::rollBack();
                return response()->json([
                    "code"    => 412,
                    "status"  => "Error",
                    "message" =>  $e->getLine() . ' ' . $e->getMessage()
                ]);
                
            }
        }

    public function edit($kode_anggota){
        $anggota = Anggota::find($kode_anggota);
        return view('back.anggota.update', compact("anggota"));
    }

    public function update(UpdateAnggotaRequest $request, $kode_anggota){
        $data = $request->validated();
     
        DB::beginTransaction();
        try {
            $user = Anggota::find($kode_anggota);
            $user->update($data);

            DB::commit();

            return redirect(route('anggota.index'))->with('success', ' Anggota has been update');
        } catch (Exception $e) {
            info($e->getMessage());
            DB::rollBack();

            return response()->json([
                "code"    => 412,
                "status"  => "Error",
                "message" =>  $e->getLine() . ' ' . $e->getMessage()
            ]);
            
        }
    }

    public function delete(Request $request){
        $validated = $request->validate([
            'kode_anggota' => 'required',
        ]);
    
        $name = Anggota::where('kode_anggota', $validated['kode_anggota'])->first();
        if ($name) {
            $name->status = Anggota::DELETED;
            $name->save();

            return $this->sendResponse($name);
        }
        return $this->sendError('Member Not Found', 404);
    }
    

    public function sendResponse($data, $message = null, $code = 200) {
        return response()->json(['success' => true, 'data' => $data, 'message' => $message], $code);
    }
    
// AnggotaController.php
public function sendError($errorMessages = [], $code = 404) {
    return response()->json(['success' => false, 'error' => $errorMessages], $code);
}
    
    public function getInfo(Request $request, $kode_anggota)
    {
        $anggota = Anggota::where('kode_anggota', $kode_anggota)->first();
        
        if ($anggota) {
            $payload = [
                'nama'     => $anggota->nama,
                'alamat'   => $anggota->alamat,
                'email'    => $anggota->email,
                'telepon'  => $anggota->telepon,
            ];
    
            return $this->sendResponse($payload);
        } else {
            return $this->sendError('Member Not Found', 404);
        }
    }
}

