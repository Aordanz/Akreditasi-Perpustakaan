<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    protected $table = 'komponen';
    public $timestamps = false;

    protected $fillable = ['nomor', 'nama_komponen'];

    public function subKomponens()
    {
        return $this->hasMany(SubKomponen::class, 'komponen_id');
    }
}
