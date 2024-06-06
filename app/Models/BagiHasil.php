<?php

namespace App\Models;

use Illuminate\{
    Database\Eloquent\Factories\HasFactory,
    Database\Eloquent\Model,
};

class BagiHasil extends Model
{
    use HasFactory;

    protected $table = 'bagi_hasil';
    protected $primaryKey = 'kode_bagi_hasil'; 
    protected $keyType = 'string'; 
    public $incrementing = false;
    protected $fillable = ['kode_bagi_hasil', 'periode', 'jumlah', 'keterangan'];

}
