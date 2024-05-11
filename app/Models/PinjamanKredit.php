<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PinjamanKredit extends Model
{
    use HasFactory;
    CONST ACTIVE          = 1;
    CONST DELETED         = 0;
    protected $table = 'pinjaman_kredit';
    protected $primaryKey = 'kode_pinjaman_kredit'; 
    protected $keyType = 'string'; 
    public $incrementing = false;
    protected $fillable = ['kode_pinjaman_kredit', 'anggota_kode', 'transaksi','tanggal', 'periode','jenis_pembayaran',
    'divisi','keterangan', 'nominal', 'bunga', 'keterangan','status_buku', 'status'];
    

     // BOOTING SECTION
     public static function booted() {
        static::addGlobalScope("active", fn($q) => $q->active());
    }

    // LOCAL SCOPE SECTION
    public function scopeActive($query){return $query->where('status', self::ACTIVE);}
    public function scopeDeleted($query){return $query->where('status', self::DELETED);}
    public function statusActive() {
        $this->status = self::ACTIVE;
        $this->save();
    }

    public function statusDelete() {
        $this->status = self::DELETED;
        $this->save();
    }

    public static function getJenisPembayaran()
    {
        return [
            'tunai'      => 'Tunai',
            'nontunai'   => 'Non Tunai'
        ];
    }
    public static function getDivisi()
    {
        return [
            'simpan'   => 'Simpan',
            'pinjam'   => 'Pinjam'
        ];
    }

    public static function getStatusBuku()
    {
        return [
            'aktif'    => 'Aktif',
            'nonaktif' => 'Nonaktif'
        ];
    }
    public static function getTransaksi()
    {
        return [
            'debet'    => 'Debet',
            'kredit'   => 'Kredit'
        ];
    }
    public static function getKeterangan()
    {
        return [
            'debet'    => 'Debet',
            'kredit'   => 'Kredit'
        ];
    }


    public function Anggota(): BelongsTo{return $this->belongsTo(Anggota::class, 'anggota_kode', 'kode_anggota');}
}
