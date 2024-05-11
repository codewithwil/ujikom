<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    use HasFactory;
    CONST ACTIVE          = 1;
    CONST DELETED         = 0;
    protected $table = 'anggota';
    protected $primaryKey = 'kode_anggota';
    protected $keyType = 'string'; 
    public $incrementing = false;

    protected $fillable = ['kode_anggota','nama', 'nik', 'alamat', 'email', 'telepon', 'status'];

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

    public function SimpananKredit(): HasMany{
        return $this->hasMany(SimpananKredit::class, 'anggota_kode', 'kode_anggota');
     }

     public function SimpananDebet(): HasMany{
        return $this->hasMany(SimpananDebet::class, 'anggota_kode', 'kode_anggota');
     }

     public function PinjamanDebet(): HasMany{
        return $this->hasMany(PinjamanDebet::class, 'anggota_kode', 'kode_anggota');
     }
}
