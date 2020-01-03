<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $fillable = ['mapel_id','tingkat','judul','deskripsi'];

    public function mapel(){
        return $this->belongsTo('App\Mapel','mapel_id');
    }
}
