<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Saldo;
use App\Models\SaldoKredit;
use Illuminate\Http\Request;

class SaldoKreditController extends Controller
{
    public  function index(){
        $saldoKredit = SaldoKredit::get();
        return view('back.saldo.saldo-kredit.index', compact('saldoKredit'));
    }
}
