<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubIndikator extends Model
{
    protected $table = 'sub_indikator';
    public $timestamps = false;

    protected $fillable = ['indikator_id', 'nomor_sub_indikator', 'nama_sub_indikator'];

    public function indikator()
    {
        return $this->belongsTo(Indikator::class, 'indikator_id');
    }

    public function dokumenBuktis()
    {
        return $this->hasMany(DokumenBukti::class, 'sub_indikator_id');
    }
}
