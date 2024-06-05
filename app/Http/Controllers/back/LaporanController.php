<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\JenisSimpanan;
use App\Models\Pengaturan;
use App\Models\PinjamanKredit;
use App\Models\Saldo;
use App\Models\SimpananDebet;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function user(){
        $users  = User::get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-user.index', compact('users', 'pengaturan'));
    }
    
    public function anggota(){
        $anggota  = Anggota::where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-anggota.index', compact('anggota', 'pengaturan'));
    }

    public function saldo(){
        $saldo      = Saldo::get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-saldo.index', compact('saldo', 'pengaturan'));
    }

    public function jenisSimpanan(){
        $jenis      = JenisSimpanan::get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-jenis-simpanan.index', compact('jenis', 'pengaturan'));       
    }

    public function simpanan(){
        $simpanan  = SimpananDebet::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        $totalProps = 0;

        // Loop through each object in the collection
        foreach ($simpanan as $item) {
            // Access the 'props' property of each object
            $props = json_decode($item->props, true);
        
            // Check if $props is an array and not empty
            if (is_array($props) && !empty($props)) {
                // Loop through each object in $props
                foreach ($props as $prop) {
                    // Check if the 'nominal' property exists and is numeric
                    if (isset($prop['nominal']) && is_numeric($prop['nominal'])) {
                        // Add the 'nominal' value to $totalProps
                        $totalProps += $prop['nominal'];
                    } else {
                        // If 'nominal' property doesn't exist or is not numeric, add 0
                        $totalProps += 0;
                    }
                }
            } else {
                // If JSON data is invalid, add 0 to $totalProps
                $totalProps += 0;
            }
        }
        return view('back.laporan.laporan-simpanan.index', compact('simpanan', 'pengaturan', 'totalProps'));
    }

    public function pinjaman(){
        $pinjaman = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-pinjaman.index', compact('pinjaman', 'pengaturan'));
    }

    public function angsuranD(){
        $simpanan = SimpananDebet::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-angsuran.debet', compact('simpanan', 'pengaturan'));
    }

    public function angsuranK(){
        $pinjaman = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-angsuran.kredit', compact('pinjaman', 'pengaturan'));
    }

    public function printUser(){
        $users      = User::get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-user.print', compact('users', 'pengaturan'));
    }

    public function printAnggota(){
        $anggota    = Anggota::where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-anggota.print', compact('anggota', 'pengaturan'));
    }

    public function printSaldo(){
        $saldo      = Saldo::get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-saldo.print', compact('saldo', 'pengaturan'));
    }

    public function printjenisSimpanan(){
        $jenis      = JenisSimpanan::get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-jenis-simpanan.print', compact('jenis', 'pengaturan'));
    }

    public function printSimpanan(){
        $simpanan  = SimpananDebet::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        $totalProps = 0;
        foreach ($simpanan as $item) {
            // Access the 'props' property of each object
            $props = json_decode($item->props, true);
        
            // Check if $props is an array and not empty
            if(is_array($props) && !empty($props)) {
                // Loop through each object in $props
                foreach ($props as $prop) {
                    // Check if the 'nominal' property is numeric
                    if (is_numeric($prop['nominal'])) {
                        // Add the 'nominal' value to $totalProps
                        $totalProps += $prop['nominal'];
                    }
                }
            }
        }
        return view('back.laporan.laporan-simpanan.print', compact('simpanan', 'pengaturan', 'totalProps'));
    }

    public function printPinjaman(){
        $pinjaman = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-pinjaman.print', compact('pinjaman', 'pengaturan'));
    }
    public function printAngsuranD(){
        $simpanan = SimpananDebet::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-angsuran.debet-print', compact('simpanan', 'pengaturan'));
    }
    public function printAngsuranK(){
        $pinjaman   = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-angsuran.kredit-print', compact('pinjaman', 'pengaturan'));
    }


    public function generatePDF()
    {
        // Ambil data pengaturan dari database
        $pengaturan = Pengaturan::first();
        $simpanan   = SimpananDebet::where('status', 1)->get();
        // Data yang ingin Anda masukkan ke PDF
        $data = [
            'simpanan'   => $simpanan,
            'pengaturan' => $pengaturan // Teruskan data pengaturan ke view PDF
        ];
    
        // Buat instance Dompdf dengan opsi
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
    
        // Load view blade yang berisi markup HTML untuk PDF
        $html = view('back.laporan.laporan-simpanan.index', $data)->render();
    
        // Tambahkan konten HTML ke PDF
        $dompdf->loadHtml($html);
    
        // Atur ukuran dan orientasi halaman
        $dompdf->setPaper('A4', 'portrait');
    
        // Render PDF (hasilnya bisa disimpan atau ditampilkan langsung)
        $dompdf->render();
    
        // Simpan PDF ke dalam file atau tampilkan ke user
        return $dompdf->stream("invoice.pdf");
    }
    
}
