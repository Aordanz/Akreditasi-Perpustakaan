<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenBukti extends Model
{
    protected $table = 'dokumen_bukti';
    public $timestamps = false;

    protected $fillable = ['sub_komponen_id', 'indikator_id', 'sub_indikator_id', 'nama_file', 'path_file', 'tanggal_upload'];

    public function subKomponen()
    {
        return $this->belongsTo(SubKomponen::class, 'sub_komponen_id');
    }

    public function indikator()
    {
        return $this->belongsTo(Indikator::class, 'indikator_id');
    }

    public function subIndikator()
    {
        return $this->belongsTo(SubIndikator::class, 'sub_indikator_id');
    }
}
