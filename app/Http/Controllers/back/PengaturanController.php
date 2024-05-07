<?php

namespace App\Http\Controllers\back;

use App\{
    Http\Controllers\Controller,
    Models\Pengaturan
};

use App\Http\Requests\setting\UpdatePengaturanRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanController extends Controller
{
    public function index(){
        $pengaturan = Pengaturan::get()->first();
        if($pengaturan){
            return view('back.pengaturan.index', [
                'pengaturan' => $pengaturan
            ]);
        }else{
            return view('back.pengaturan.index', [
                'pengaturan' => null
            ]);
        }
    }

    public function store(UpdatePengaturanRequest $request){
        $data = $request->validated();

        DB::beginTransaction();
        try {
            if ($request->hasFile('foto_perusahaan')) {
                $checkingFile = $request->file('foto_perusahaan');
                $filename = $checkingFile->getClientOriginalName();
                $path = $checkingFile->storeAs('public/back/pengaturan',$filename);
                $data['foto_perusahaan'] = $filename;
            }

            Pengaturan::create($data);
            DB::commit();

            return redirect(route('pengaturan.index'))->with('success', ' Setting has been update');
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

    public function update(UpdatePengaturanRequest $request, $id){
        $data = $request->validated();

        DB::beginTransaction();
        try {
            if ($request->hasFile('foto_perusahaan')) {
                $checkingFile = $request->file('foto_perusahaan');
                $filename = $checkingFile->getClientOriginalName();
                $path = $checkingFile->storeAs('public/back/pengaturan',$filename);
                $data['foto_perusahaan'] = $filename;
            }

            $pengaturan = Pengaturan::find($id);
            $pengaturan->update($data);
            DB::commit();

            return redirect(route('pengaturan.index'))->with('success', ' Setting has been update');
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


}
