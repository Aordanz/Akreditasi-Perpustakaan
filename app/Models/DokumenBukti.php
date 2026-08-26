<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DokumenBukti extends Model
{
    use SoftDeletes;
    
    protected $table = 'dokumen_bukti';
    public $timestamps = false;

    protected $fillable = ['sub_komponen_id', 'indikator_id', 'sub_indikator_id', 'kode_dokumen', 'nama_file', 'path_file', 'tanggal_upload'];

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

    public function getIsYoutubeAttribute()
    {
        return str_contains($this->path_file, 'youtube.com') || str_contains($this->path_file, 'youtu.be');
    }

    public function getIsDriveAttribute()
    {
        return str_contains($this->path_file, 'drive.google.com') || str_contains($this->path_file, 'docs.google.com');
    }

    public function getYoutubeEmbedUrlAttribute()
    {
        $url = $this->path_file;
        $videoId = '';
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match)) {
            $videoId = $match[1];
        }
        return $videoId ? 'https://www.youtube.com/embed/' . $videoId : $url;
    }
}
