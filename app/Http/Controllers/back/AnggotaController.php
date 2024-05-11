<?php

namespace App\Http\Controllers\back;

use App\{
    Models\Anggota,
    Http\Controllers\Controller,
    Http\Requests\anggota\CreateAnggotaRequest
};
use App\Http\Requests\anggota\UpdateAnggotaRequest;
use Illuminate\{
    Http\Request,
    Support\Facades\DB
};
use Exception;

class AnggotaController extends Controller
{
    public function index(){
        $anggota = Anggota::where('status', 1)->get();
        return view('back.anggota.index', [
            'anggota' => $anggota
        ]);
    }

    public function create(){
        return view('back.anggota.create');
    }

    public function store(CreateAnggotaRequest $request){
        $data = $request->validated();
        $data['status'] = 1;

        DB::beginTransaction();
        try {
            $kode_anggota = autonumber('anggota', 'kode_anggota', 3, 'ANG');
            $data['kode_anggota'] = $kode_anggota;
            Anggota::create($data);

            DB::commit();

            return redirect(route('anggota.index'))->with('success', ' Anggota has been created');
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

    public function edit($kode_anggota){
        return view('back.anggota.update',[
            'anggota'   => Anggota::find($kode_anggota)
        ]);
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
            return response()->json(['message' => 'Anggota status updated successfully'], 200);
        }
        return response()->json(['message' => 'Anggota not found'], 404);
    }
    
    public function getInfo(Request $request, $kode_anggota)
    {
        $anggota = Anggota::where('kode_anggota', $kode_anggota)->first();

        if ($anggota) {
            return response()->json([
                'nama' => $anggota->nama,
                'alamat' => $anggota->alamat,
                'email' => $anggota->email,
                'telepon' => $anggota->telepon,
            ]);
        } else {
            return response()->json(['error' => 'Anggota tidak ditemukan.'], 404);
        }
    }
}

