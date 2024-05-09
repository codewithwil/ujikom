<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;
    CONST ACTIVE          = 1;
    CONST DELETED         = 0;
    protected $table      = 'saldo';
    protected $primaryKey = 'id_saldo';
    protected $fillable   = ['saldo', 'keterangan', 'status'];

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
}
