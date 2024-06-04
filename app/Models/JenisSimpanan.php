<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSimpanan extends Model
{
    use HasFactory;
    protected $table = 'jenis_simpanan';
    protected $primaryKey = 'kode_jenis_simpanan';
    protected $keyType = 'string'; 
    public $incrementing = false;

    protected $fillable = ['kode_jenis_simpanan','nama', 'nominal',];

}
