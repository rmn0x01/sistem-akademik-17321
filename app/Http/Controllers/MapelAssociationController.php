<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Guru;
use App\Mapel;
use App\MapelAssociation;


class MapelAssociationController extends Controller
{
    public function __consruct(){
        $this->middleware('admin');
    }

    public function index(){
        $list_mapel_assoc = MapelAssociation::all();
        return view('mapel_assoc',['list_mapel_assoc'=>$list_mapel_assoc]);
    }

    public function create(){
        $list_mapel = Mapel::all();
        $list_guru = Guru::all();
        $list_kelas = Kelas::all();
        return view('mapel_assoc_create',[
            'list_mapel'=>$list_mapel,
            'list_guru'=>$list_guru,
            'list_kelas'=>$list_kelas,
        ]);
    }

    public function processCreate(Request $request){
        $this->validate($request,[
            'kelas_id'=>'required|integer',
            'mapel_id'=>'required|integer',
            'pengampu_id'=>'required|integer',
        ]);

        MapelAssociation::create([
            'mapel_id'=>$request->mapel_id,
            'kelas_id'=>$request->kelas_id,
            'pengampu_id'=>$request->pengampu_id,
        ]);

        return redirect('/mapelassoc');
    }

    public function edit($id){
        $list_mapel = Mapel::all();
        $list_guru = Guru::all();
        $list_kelas = Kelas::all();
        $mapel_assoc = MapelAssociation::where('id',$id)->first();
        return view('mapel_assoc_edit',[
            'mapel_assoc'=>$mapel_assoc,
            'list_mapel'=>$list_mapel,
            'list_guru'=>$list_guru,
            'list_kelas'=>$list_kelas,]);
    }

    public function processEdit(Request $request){
        //IDOR Vuln. Ditambal pake middleware admin
        $this->validate($request,[
            'kelas_id'=>'required|integer',
            'mapel_id'=>'required|integer',
            'pengampu_id'=>'required|integer',
        ]);
        MapelAssociation::where('id',$request->id)->update([
            'mapel_id'=>$request->mapel_id,
            'kelas_id'=>$request->kelas_id,
            'pengampu_id'=>$request->pengampu_id,
        ]);

        return redirect('/mapelassoc');
    }

    public function delete($id){
        MapelAssociation::where('id',$id)->delete();
        return redirect('/mapelassoc');
    }
}
