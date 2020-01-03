<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materi;
use App\Mapel;
use Auth;

class MateriController extends Controller
{
    // Rencana wewenang upload materi di admin pengajaran, karena materi di tingkat sekolah
    // masih seragam meski ruangan berbeda (contoh: materi IPA MIA 1 dan MIA 2 pasti sama)
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin', ['except' => [
            'index',
            'materiMapel',
            'detailMateri',
        ]]);
    }

    public function index(){
        $list_mapel = Mapel::all();
        return view('materi',['list_mapel'=>$list_mapel]);
    }

    public function materiMapel($mapel_id, $tingkat){
        $list_materi = Materi::where('mapel_id',$mapel_id)->where('tingkat',$tingkat)->get();
        $data_mapel = Mapel::where('id',$mapel_id)->first();
        if($data_mapel == NULL){
            abort(404);
        }
        $user_role = Auth::user()->role;
        if ($user_role == 0){
            $admin = True;
        } else {
            $admin = False;
        }
        return view('materi_mapel',[
            'list_materi'=>$list_materi,
            'data_mapel'=>$data_mapel,
            'tingkat'=>$tingkat,
            'admin'=>$admin,
            ]);
    }

    public function add($mapel_id, $tingkat){
        $data_mapel = Mapel::where('id',$mapel_id)->first();
        return view('materi_add',[
            'data_mapel'=>$data_mapel,
            'tingkat'=>$tingkat,
        ]);
    }

    public function addProcess(Request $request){
        $this->validate($request,[
            'mapel_id'=>'required|integer',
            'tingkat'=>'required|integer',
            'judul'=>'required|string',
            'deskripsi'=>'required',
        ]);

        Materi::create([
            'mapel_id'=>$request->mapel_id,
            'tingkat'=>$request->tingkat,
            'judul'=>$request->judul,
            'deskripsi'=>$request->deskripsi,
        ]);
        $link = '/materi/mapel/' . $request->mapel_id . "/" . $request->tingkat;
        return redirect($link);
    }

    public function detailMateri($id){
        $materi = Materi::where('id',$id)->first();
        $user_role = Auth::user()->role;
        if ($user_role == 0){
            $admin = True;
        } else {
            $admin = False;
        }
        
        if($materi != null){
            return view('materi_detail',[
                'materi'=>$materi,
                'admin'=>$admin,
                ]);
        } else {
            abort(404);
        }
        
    }

    public function edit($id){
        $materi = Materi::where('id',$id)->first();
        return view('materi_edit',['materi'=>$materi]);
    }

    public function editProcess(Request $request){
        
        $this->validate($request,[
            'id'=>'required',
            'judul'=>'required|string',
            'deskripsi'=>'required',
        ]);

        Materi::where('id',$request->id)->update([
            'judul'=>$request->judul,
            'deskripsi'=>$request->deskripsi,
        ]);
        return redirect('/materi/detail/'.$request->id);
    }

    public function delete($id){
        $to_be_deleted = Materi::where('id',$id);
        $current = $to_be_deleted->first()->mapel_id .'/'. $to_be_deleted->first()->tingkat;
        $link = '/materi/mapel/'.$current;
        $to_be_deleted->delete();
        return redirect($link);
    }

}
