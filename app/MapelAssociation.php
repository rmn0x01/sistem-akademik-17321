<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapelAssociation extends Model
{
    protected $table = 'mapel_association';
    protected $fillable = ['mapel_id','kelas_id','pengampu_id'];

    public function mapel(){
        return $this->belongsTo('App\Mapel','mapel_id');
    }

    public function kelas(){
        return $this->belongsTo('App\Kelas','kelas_id');
    }

    public function guru(){
        return $this->belongsTo('App\Guru','pengampu_id');
    }

    public function jadwal(){
        return $this->hasMany('App\Jadwal','mapel_assoc_id');
    }

    public function tugas(){
        return $this->hasMany('App\Tugas','mapel_assoc_id');
    }
}
