<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['user_id','nama_lengkap','NIS','kelas_sekarang'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function kelas(){
        return $this->belongsTo('App\Kelas','kelas_sekarang');
    }
    public function tugas_upload(){
        return $this->hasMany('App\TugasUpload','siswa_id');
    }
}
