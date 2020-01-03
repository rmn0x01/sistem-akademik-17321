<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use App\MapelAssociation;

class JadwalController extends Controller
{
    

    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        //TODO
        //Bikin dashboard jadwal management buat admin
    }

    //linked with mapel_assoc
    public function detail($id){
        $mapel_assoc = MapelAssociation::where('id',$id)->first();
        $list_jadwal = Jadwal::where('mapel_assoc_id',$id)->get();
        return view('jadwal_mapel',['list_jadwal'=>$list_jadwal, 'mapel_assoc'=>$mapel_assoc]);
    }

    public function addProcess(Request $request){
        $this->validate($request,[
            'mapel_assoc_id'=>'required|integer',
            'hari'=>'required', //TODO, validasi hari senin-sabtu, mencegah edit inspect element
            'jam_mulai'=>'required', //TODO, validasi waktu
            'jam_selesai'=>'required', //TODO, validasi waktu
        ]);

        Jadwal::create([
            'mapel_assoc_id'=>$request->mapel_assoc_id,
            'hari'=>$request->hari,
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
        ]);
        $link = '/jadwal/detail/' . $request->mapel_assoc_id;
        return redirect($link);
    }

    public function delete($id){
        $mapel_assoc_id = Jadwal::where('id',$id)->first();
        $mapel_assoc_id = $mapel_assoc_id->mapel_assoc_id;
        Jadwal::where('id',$id)->delete();
        $link = '/jadwal/detail/' . $mapel_assoc_id;
        return redirect($link);
    }

}
