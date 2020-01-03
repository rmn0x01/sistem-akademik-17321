<?php
//BELUM DI-MIGRATE

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $fillable = ['mapel_assoc_id','hari','jam_mulai','jam_selesai'];

    public function mapelassociation(){
        return $this->belongsTo('App\MapelAssociation','mapel_assoc_id');
    }
}
