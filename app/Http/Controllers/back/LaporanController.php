<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Models\PinjamanKredit;
use App\Models\SimpananDebet;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function simpanan(){
        $simpanan  = SimpananDebet::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-simpanan.index', compact('simpanan', 'pengaturan'));
    }

    public function pinjaman(){
        $pinjaman = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-pinjaman.index', compact('pinjaman', 'pengaturan'));
    }

    public function printSimpanan(){
        $simpanan  = SimpananDebet::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-simpanan.print', compact('simpanan', 'pengaturan'));
    }

    public function printPinjaman(){
        $pinjaman = PinjamanKredit::with('Anggota')->where('status', 1)->get();
        $pengaturan = Pengaturan::get();
        return view('back.laporan.laporan-pinjaman.print', compact('pinjaman', 'pengaturan'));
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
