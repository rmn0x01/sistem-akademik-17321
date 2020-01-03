<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['tingkat','wali_kelas','ruangan'];

    public function siswa(){
        return $this->hasMany('App\Siswa','kelas_sekarang');
    }

    public function guru(){
        return $this->belongsTo('App\Guru','wali_kelas');
    }

    public function mapelassociation(){
        return $this->hasMany('App\MapelAssociation','kelas_id');
    }
}
