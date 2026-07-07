<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
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
}
