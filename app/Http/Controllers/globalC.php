<?php

namespace App\Http\Controllers;

use App\Models\{
    PinjamanDebet,
    Anggota,
    SimpananDebet,
};

class globalC extends Controller
{
    protected function getAttr() {
        $jenisBayar = PinjamanDebet::getJenisPembayaran();
        $divisi     = PinjamanDebet::getDivisi();
        $transaksi  = PinjamanDebet::getTransaksi();
        $anggota    = Anggota::get();
        $statusBuku = PinjamanDebet::getStatusBuku();
        $keterangan = PinjamanDebet::getKeterangan();
        
        return [$jenisBayar,$divisi,$transaksi,$anggota,$statusBuku,$keterangan];
    }

    protected function getAttrA(){
        $jenisBayar = SimpananDebet::getJenisPembayaran();
        $divisi     = SimpananDebet::getDivisi();
        $transaksi  = SimpananDebet::getTransaksi();
        $statusBuku = SimpananDebet::getStatusBuku();
        $keterangan = SimpananDebet::getKeterangan();
        return [$jenisBayar,$divisi,$transaksi,$statusBuku,$keterangan];
    }

    protected function sendResponse($result, $code = 200, $message = 'Success.') {
        $response = [
            'code'     => $code,
            'success'  => true,
            'messages' => $message,
            'data'     => $result,
        ];

        return response()->json($response, $code);
    }

    public function sendError($errorMessages = [], $code = 404) {
        $response = [
            'code'     => $code,
            'success'  => false,
            'messages' => '',
            'data'     => NULL
        ];

        if (!empty($errorMessages)) {
            if (is_array($errorMessages)) {
                foreach ($errorMessages as $item) {
                    if (is_array($item)) {
                        $response['messages'] .= implode(' ', $item);
                    } else {
                        if (strlen($response['messages']) > 0) {
                            $response['messages'] .= ' ';
                        }
                        $response['messages'] .= $item;
                    }
                }
            } else {
                $response['messages'] = $errorMessages;
            }
        }

        return response()->json($response, $code);
    }


}
