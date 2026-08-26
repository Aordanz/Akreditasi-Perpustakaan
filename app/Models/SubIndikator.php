<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubIndikator extends Model
{
    use SoftDeletes;
    
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
