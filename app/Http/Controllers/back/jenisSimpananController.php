<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\JenisSimpanan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class jenisSimpananController extends Controller
{
    public function index(){
        $jenis = JenisSimpanan::get();
        return view('back.jenis-simpanan.index', [
            'jenis' => $jenis
        ]);
    }

    public function create(){
        return view('back.jenis-simpanan.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'kode_jenis_simpanan'  => 'required|max:10',  
            'nama'  => 'required|max:70',  
            'nominal'  => 'nullable|max:11',  
        ]);
        DB::beginTransaction();
        try {
            JenisSimpanan::create($data);

            DB::commit();

            return redirect(route('jenisSimpanan.index'))->with('success', ' jenis simpanan has been created');
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

    public function edit($kode_jenis_simpanan){
        return view('back.jenis-simpanan.update',[
            'jenis' => JenisSimpanan::find($kode_jenis_simpanan)
        ]);
    }

    public function update(Request $request, $kode_jenis_simpanan){
        $data = $request->validate([
            'nama'=> 'nullable|max:70',
            'nominal'=> 'nullable|max:11',
        ]);
        DB::beginTransaction();
        try {
            $jenis = JenisSimpanan::find($kode_jenis_simpanan);
            $jenis->update($data);

            DB::commit();

            return redirect(route('jenisSimpanan.index'))->with('success', ' jenis simpanan has been created');
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
            'kode_jenis_simpanan' => 'required',
        ]);
    
        $data = JenisSimpanan::where('kode_jenis_simpanan', $validated['kode_jenis_simpanan'])->first();
        if ($data) {
            $data->delete();
            return response()->json(['message' => 'Jenis Simpanan delete successfully'], 200);
        }
        return response()->json(['message' => 'Jenis Simpanan not found'], 404);
    }
}
