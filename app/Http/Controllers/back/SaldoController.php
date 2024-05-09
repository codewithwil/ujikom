<?php

namespace App\Http\Controllers\back;


use App\{
    Http\Requests\saldo\UpdateSaldoRequest,
    Http\Requests\saldo\CreateSaldoRequest,
    Http\Controllers\Controller,
    Models\Saldo
};
use Illuminate\{
    Http\Request,
    Support\Facades\DB
};
use Exception;

class SaldoController extends Controller
{
    public function index(){
        $saldo = Saldo::get();
        return view('back.saldo.index', [
            'saldo'     => $saldo
        ]);
    }

    public function create(){
        return view('back.saldo.create');
    }

    public function store(CreateSaldoRequest $request){
        $data = $request->validated();
        $data['status'] = 1;

        DB::beginTransaction();
        try {
            Saldo::create($data);

            DB::commit();

            return redirect(route('saldo.index'))->with('success', ' Saldo has been created');
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

    public function edit($id_saldo) {
        return view('back.saldo.update',[
            'saldo' => Saldo::find($id_saldo)
        ]);
    }

    public function update(UpdateSaldoRequest $request, $id_saldo){
        $data = $request->validated();
     
        DB::beginTransaction();
        try {
            $user = Saldo::find($id_saldo);
            $user->update($data);

            DB::commit();

            return redirect(route('saldo.index'))->with('success', ' Saldo has been update');
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
            'id_saldo' => 'required',
        ]);
    
        $name = Saldo::where('id_saldo', $validated['id_saldo'])->first();
        if ($name) {
            $name->status = Saldo::DELETED;
            $name->save();
            return response()->json(['message' => 'Saldo status updated successfully'], 200);
        }
        return response()->json(['message' => 'Saldo not found'], 404);
    }
}
