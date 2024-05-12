<?php
function hitungCicilan($nominal, $bunga, $periode) {
    $bunga_decimal = $bunga / 100;
    $cicilan = ($nominal * (1 + $bunga_decimal)) / $periode;
    return $cicilan;
}