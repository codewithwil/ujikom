<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $anggota = Anggota::where('status', 1)->count();
        $saldo = Saldo::sum('saldo'); 
        $pegawai = User::count();
        return view('back.dashboard.index',[
            'anggota' => $anggota,
            'saldo'   => $saldo,
            'pegawai' => $pegawai  
        ]);
    }

    public function dailySimpananTransactions()
    {
        $transactions = DB::table('simpanan_debet')
            ->select(DB::raw('DATE_FORMAT(tanggal, "%Y-%m-%d") as date'), DB::raw('COUNT(*) as transactions_count'))
            ->whereNotNull('tanggal')
            ->groupBy('date')
            ->get();
    
        return response()->json($transactions);
    }
    
    public function dailyPinjamanTransactions()
    {
        $transactions = DB::table('pinjaman_debet')
            ->select(DB::raw('DATE_FORMAT(tanggal, "%Y-%m-%d") as date'), DB::raw('COUNT(*) as transactions_count'))
            ->whereNotNull('tanggal')
            ->groupBy('date')
            ->get();
    
        return response()->json($transactions);
    }
}
