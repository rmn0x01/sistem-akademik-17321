<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable=['nama_mapel','deskripsi'];

    public function mapelassociation(){
        return $this->hasMany('App\MapelAssociation','mapel_id');
    }

    public function jadwal(){
        return $this->hasMany('App\Jadwal','mapel_id');
    }
}
