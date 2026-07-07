<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenBukti extends Model
{
    protected $table = 'dokumen_bukti';
    public $timestamps = false;

    protected $fillable = ['sub_komponen_id', 'nama_file', 'path_file', 'tanggal_upload'];

    public function subKomponen()
    {
        return $this->belongsTo(SubKomponen::class, 'sub_komponen_id');
    }
}
