<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['user_id','nama_depan','nama_belakang','NIP','no_hp','tanggal_lahir'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function kelas(){
        return $this->hasOne('App\Kelas','wali_kelas');
    }

    public function mapelassociation(){
        return $this->hasMany('App\MapelAssociation','pengampu_id');
    }    
}
