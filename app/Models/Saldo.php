<?php

namespace App\Models;

use Illuminate\{
    Database\Eloquent\Factories\HasFactory,
    Database\Eloquent\Model,
};

class Saldo extends Model
{
    use HasFactory;

    protected $table      = 'saldo';
    protected $primaryKey = 'id_saldo';
    protected $fillable   = ['saldo', 'keterangan',];

}
