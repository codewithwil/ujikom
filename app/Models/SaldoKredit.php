<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoKredit extends Model
{
    use HasFactory;
    protected $table      = 'saldo_kredit';
    protected $primaryKey = 'id_saldo_kredit';
    protected $fillable   = ['saldo', 'keterangan',];
}
