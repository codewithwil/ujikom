<?php

use Illuminate\Support\Facades\DB;

function autonumber($tabel, $kolom, $lebar = 0, $awalan)
{
    $latestRecord = DB::table($tabel)->orderBy($kolom, 'desc')->first();

    if (!$latestRecord) {
        $nomor = 1;
    } else {
        $nomor = intval(substr($latestRecord->$kolom, strlen($awalan))) + 1;
    }

    if ($lebar > 0) {
        $angka = $awalan . str_pad($nomor, $lebar, "0", STR_PAD_LEFT);
    } else {
        $angka = $awalan . $nomor;
    }

    return $angka;

}
