<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\globalC;
use App\Models\Anggota;
use App\Models\PinjamanDebet;
use App\Models\Saldo;
use App\Models\SimpananDebet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends globalC
{
    public function index() {
        $member  = Anggota::selectRaw("COUNT(*) AS value")->first();
        $saldo   = Saldo::selectRaw('SUM(saldo) AS value')->first(); 
        $pegawai = User::selectRaw('COUNT(*) AS value')->first();

        return view('back.dashboard.index',compact('anggota', 'saldo', 'pegawai'));
    }

    public function dailySimpananTransactions() {
        $transactions = SimpananDebet::selectRaw('
            DATE_FORMAT(tanggal, %Y-%m-%d) AS date,
            COUNT(*) AS transactions_count
        ')->whereNotNull('tanggal')
          ->groupBy('date')
          ->get();
    
        return $this->sendResponse($transactions);
    }
    
    public function dailyPinjamanTransactions() {
        $transactions = PinjamanDebet::selectRaw('
            DATE_FORMAT(tanggal, %Y-%m-%d) AS date,
            COUNT(*) AS transactions_count
        ')->whereNotNull('tanggal')
          ->groupBy('date')
          ->get();
    
        return $this->sendResponse($transactions);
    }
}
