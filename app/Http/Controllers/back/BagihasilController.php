<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\BagiHasil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BagihasilController extends Controller
{
    public function index(){
        $bagiHasil = BagiHasil::get();
        return view('back.bagi-hasil.index',[
            'bagiHasil' => $bagiHasil
        ]);
    }

    public function create(){
        return view('back.bagi-hasil.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'kode_bagi_hasil'   => 'required|max:10',
            'jumlah'           => 'required|max:11',
            'keterangan'        => 'nullable|max:255',
        ]);
        DB::beginTransaction();
        try {
            DB::commit();
            BagiHasil::create($data);
            return redirect(route('bagiHasil.index'))->with('success', ' User has been created');
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

    public function edit($kode_bagi_hasil){
        return view('back.bagi-hasil.update',[
            'bagiHasil' => BagiHasil::find($kode_bagi_hasil)
        ]);
    }

    public function update(Request $request, $kode_bagi_hasil){
        $data = $request->validate([
            'kode_bagi_hasil'   => 'nullable|max:10',
            'jumlah'            => 'nullable|max:11',
            'keterangan'        => 'nullable|max:255',
        ]);
        DB::beginTransaction();
        try {
            DB::commit();
            BagiHasil::find($kode_bagi_hasil)->update($data);
            return redirect(route('bagiHasil.index'))->with('success', ' User has been updated');
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
            'kode_bagi_hasil' => 'required',
        ]);
    
        $data = BagiHasil::where('kode_bagi_hasil', $validated['kode_bagi_hasil'])->first();
        if ($data) {
            $data->delete();
            return response()->json(['message' => 'Bagi hasil delete successfully'], 200);
        }
        return response()->json(['message' => 'Bagi hasil not found'], 404);
    }
}
