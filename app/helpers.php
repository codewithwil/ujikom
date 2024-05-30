<?php

use Illuminate\Support\Facades\DB;

function autonumber($tabel, $kolom, $awalan, $lebar = 0)
{
    // Get the latest record from the specified table and column
    $latestRecord = DB::table($tabel)->orderBy($kolom, 'desc')->first();

    // If there are no records, set the number to 1
    if (!$latestRecord) {
        $nomor = 1;
    } else {
        // Extract the number portion after the prefix from the latest record,
        // increment it by 1, and convert it to an integer
        $nomor = intval(substr($latestRecord->$kolom, strlen($awalan))) + 1;
    }

    // Convert $lebar to an integer
    $lebar = (int)$lebar;

    // Pad the number with zeros to the specified length if provided
    if ($lebar > 0) {
        $angka = $awalan . str_pad($nomor, $lebar, "0", STR_PAD_LEFT);
    } else {
        $angka = $awalan . $nomor;
    }

    // Return the generated automatic number
    return $angka;
}
