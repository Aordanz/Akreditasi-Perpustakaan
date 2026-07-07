<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKomponen extends Model
{
    protected $table = 'sub_komponen';
    public $timestamps = false;

    protected $fillable = ['komponen_id', 'nomor_sub', 'nama_sub_komponen'];

    public function komponen()
    {
        return $this->belongsTo(Komponen::class, 'komponen_id');
    }

    public function indikators()
    {
        return $this->hasMany(Indikator::class, 'sub_komponen_id');
    }

    public function dokumenBuktis()
    {
        return $this->hasMany(DokumenBukti::class, 'sub_komponen_id');
    }
}
