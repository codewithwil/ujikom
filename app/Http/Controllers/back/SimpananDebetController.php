<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SimpananDebetController extends Controller
{
    public function index(){
        return view('back.simpanan.simpanan-debet.index');
    }
}
