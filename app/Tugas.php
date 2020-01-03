<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';

    protected $fillable = ['mapel_assoc_id','tugas_judul','tugas_deskripsi','tugas_deadline'];

    public function mapelassociation(){
        return $this->belongsTo('App\MapelAssociation','mapel_assoc_id');
    }

    public function tugas_upload(){
        return $this->hasMany('App\TugasUpload','tugas_id');
    }
}
