<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indikator extends Model
{
    use SoftDeletes;
    
    protected $table = 'indikator';
    public $timestamps = false;

    protected $fillable = ['sub_komponen_id', 'nomor_indikator', 'nama_indikator'];

    public function subKomponen()
    {
        return $this->belongsTo(SubKomponen::class, 'sub_komponen_id');
    }

    public function subIndikators()
    {
        return $this->hasMany(SubIndikator::class, 'indikator_id');
    }

    public function dokumenBuktis()
    {
        return $this->hasMany(DokumenBukti::class, 'indikator_id');
    }
}
