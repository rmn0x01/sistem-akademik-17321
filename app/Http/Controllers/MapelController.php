<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mapel;

class MapelController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $list_mapel = Mapel::all();
        return view('mapel',['list_mapel'=>$list_mapel]);
    }

    public function createMapel(){
        return view('mapel_create');
    }

    public function processCreateMapel(Request $request){
        $this ->validate($request,[
            'nama_mapel'=>'required|max:100',
            'deskripsi'=>'required',
        ]);

        Mapel::create([
            'nama_mapel'=>$request->nama_mapel,
            'deskripsi'=>$request->deskripsi,
        ]);
        return redirect('/mapel');
    }

    public function editMapel($id){
        $mapel = Mapel::where('id',$id)->first();
        return view('mapel_edit',['mapel'=>$mapel]);
    }

    public function processEditMapel(Request $request){
        //IDOR Vuln. Ditambal pake middleware admin
        $this->validate($request,[
            'nama_mapel'=>'required|max:100',
            'deskripsi'=>'required',
        ]);
        
        Mapel::where('id',$request->id)->update([
            'nama_mapel' => $request->nama_mapel,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/mapel');
    }

    public function deleteMapel($id){
        Mapel::where('id',$id)->delete();
        return redirect('/mapel');
    }

}
