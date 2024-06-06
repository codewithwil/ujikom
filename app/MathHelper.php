<?php
function hitungCicilan($nominal, $bunga, $periode) {
    // Memastikan semua parameter adalah numerik
    if (!is_numeric($nominal) || !is_numeric($bunga)) {
        throw new InvalidArgumentException("Nominal dan bunga harus berupa nilai numerik.");
    }

    // Mengambil bagian numerik dari periode
    $periode_angka = intval($periode);

    // Memastikan periode tidak sama dengan nol untuk menghindari pembagian oleh nol
    if ($periode_angka == 0) {
        return 0; // Mengembalikan 0 jika periode adalah 0
    }

    // Konversi parameter menjadi tipe data numerik jika diperlukan
    $nominal = floatval($nominal);
    $bunga = floatval($bunga);

    // Melakukan perhitungan cicilan
    $bunga_decimal = $bunga / 100;
    $cicilan = ($nominal * (1 + $bunga_decimal)) / $periode_angka;

    return $cicilan;
}

