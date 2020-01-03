<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TugasUpload extends Model
{
    protected $table = 'tugas_upload';
    protected $fillable = ['tugas_id','siswa_id','upload_file','upload_nilai','upload_komentar'];

    public function tugas(){
        return $this->belongsTo('App\Tugas','tugas_id');
    }

    public function siswa(){
        return $this->belongsTo('App\Siswa','siswa_id');
    }
}
