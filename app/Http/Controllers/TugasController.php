<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tugas;
use App\MapelAssociation;
use App\TugasUpload;
use App\Siswa;
use Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class TugasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('guru',['except' => [
            'getTugasKelas',
            'getTugasMapel',
            'getDetailTugas',
        ]]);
    }

    public function getTugasKelas(){
        $user_id = Auth::id();
        $kelas = Siswa::where('user_id',$user_id)->first()->kelas;
        $kelas_id = $kelas->mapelassociation()->select('id')->get()->toArray();
        $mapel_assoc_id = array();
        foreach($kelas_id as $kelas){
            array_push($mapel_assoc_id,$kelas['id']);
        };
        $list_mapel = Tugas::distinct()->select('mapel_assoc_id')->wherein('mapel_assoc_id',$mapel_assoc_id)->groupBy('mapel_assoc_id')->get();
        return view('tugas_kelas',['list_mapel'=>$list_mapel]);
    }

    public function getTugasMapel($mapel_assoc_id){
        $role = Auth::user()->role;
        if($role == 2){
            $kelas_id = Auth::user()->siswa->kelas->id;
            $mapel_assoc_kelas_id = MapelAssociation::where('id',$mapel_assoc_id)->select('kelas_id')->first();
            if($mapel_assoc_kelas_id == NULL){
                abort(404);
            } else{
                $mapel_assoc_kelas_id = $mapel_assoc_kelas_id->toArray();
            }
            if($kelas_id != $mapel_assoc_kelas_id['kelas_id']){
                abort(404);
            } else {
                $list_tugas = Tugas::where('mapel_assoc_id',$mapel_assoc_id)->get();
                return view('tugas_mapel',['list_tugas'=>$list_tugas]);
            }
        } else if($role == 1){
            $guru_id = Auth::user()->guru->id;
            $mapel_assoc_pengampu_id = MapelAssociation::where('id',$mapel_assoc_id)->select('pengampu_id')->first();
            if($mapel_assoc_pengampu_id == NULL){
                abort(404);
            } else{
                $mapel_assoc_pengampu_id = $mapel_assoc_pengampu_id->toArray();
            }
            if($guru_id != $mapel_assoc_pengampu_id['pengampu_id']){
                abort(404);
            } else {
                $list_tugas = Tugas::where('mapel_assoc_id',$mapel_assoc_id)->get();
                return view('tugas_mapel',['list_tugas'=>$list_tugas]);
            }
        }
    }

    public function getDetailTugas($tugas_id){
        //cek manusia iseng ganti url
        $user_role = Auth::user()->role;
        if($user_role == 2){
            $kelas_id = Auth::user()->siswa->kelas->id;
            $mapel_assoc_kelas_id = Tugas::where('tugas_id',$tugas_id)->first();
            if(($mapel_assoc_kelas_id == NULL) or ($kelas_id != $mapel_assoc_kelas_id->mapelassociation()->first()->kelas_id)){    
                abort(404);
            }
        } else if($user_role == 1){
            $guru_id = Auth::user()->guru->id;
            $mapel_assoc_pengampu_id = Tugas::where('tugas_id',$tugas_id)->first();
            if(($mapel_assoc_pengampu_id == NULL) or ($guru_id != $mapel_assoc_pengampu_id->mapelassociation()->first()->pengampu_id)){    
                abort(404);
            }
        }
        
        $tugas = Tugas::where('tugas_id',$tugas_id)->first();
        $user_role = Auth::user()->role;
        
        $deadline = Carbon::createFromFormat('Y-m-d H:i:s', $tugas->tugas_deadline);
        $today = Carbon::now();
        $data_difference = $today->diffInSeconds($deadline, false);
        if($data_difference > 0){
            $pastDeadline = False;
        } else {
            $pastDeadline = True;
        }
        
        $tugas_upload = NULL;
        if ($user_role == 2){
            $siswa_id = Auth::user()->siswa->id;
            $tugas_upload = TugasUpload::where('tugas_id',$tugas_id)->where('siswa_id',$siswa_id)->first();
            $isSiswa = True;
        } else {
            $isSiswa = False;
        }
        return view('tugas_detail',[
            'tugas'=>$tugas, 
            'is_siswa'=>$isSiswa, 
            'tugas_upload'=>$tugas_upload,            
            'past_deadline'=>$pastDeadline,
            ]);
    }

    public function addTugas(){
        $id = Auth::user()->guru->id;
        // $mapel_assoc_id_available = array();
        // foreach($id as $d){
        //     array_push($mapel_assoc_id_available, $d->id);
        // }
        // echo $mapel_assoc_id_available;
        // die;
        $list_mapel = MapelAssociation::where('pengampu_id',$id)->get();
        return view('tugas_add',['list_mapel'=>$list_mapel]);
    }
    
    public function addProcess(Request $request){
        $id = Auth::user()->guru->mapelassociation()->get();
        $mapel_assoc_id_available = array();
        foreach($id as $d){
            array_push($mapel_assoc_id_available, $d->id);
        }
        $this->validate($request,[
            'mapel_assoc_id'=> [
                'required',
                Rule::in($mapel_assoc_id_available),
            ], 
            'tugas_judul'=>'required|string',
            'tugas_deskripsi'=>'required',
            'tugas_deadline'=>'required',
        ]);

        Tugas::create([
            'mapel_assoc_id'=>$request->mapel_assoc_id,
            'tugas_judul'=>$request->tugas_judul,
            'tugas_deskripsi'=>$request->tugas_deskripsi,
            'tugas_deadline'=>$request->tugas_deadline,
        ]);

        return redirect('/guru/mapel');
    }

    public function edit($tugas_id){
        $guru_id = Auth::user()->guru->id;
        $mapel_assoc_pengampu_id = Tugas::where('tugas_id',$tugas_id)->first();
        if(($mapel_assoc_pengampu_id == NULL) or ($guru_id != $mapel_assoc_pengampu_id->mapelassociation()->first()->pengampu_id)){    
            abort(404);
        }
        $tugas = Tugas::where('tugas_id',$tugas_id)->first();
        return view('tugas_edit',['tugas'=>$tugas]);
    }

    public function editProcess($tugas_id, Request $request){
        //jaga2 diisengin burpsuite
        $guru_id = Auth::user()->guru->id;
        $mapel_assoc_pengampu_id = Tugas::where('tugas_id',$tugas_id)->first();
        if(($mapel_assoc_pengampu_id == NULL) or ($guru_id != $mapel_assoc_pengampu_id->mapelassociation()->first()->pengampu_id)){    
            abort(404);
        }
        //validation rule masih kurang
        $this->validate($request,[
            'tugas_judul'=>'required|string',
            'tugas_deskripsi'=>'required',
            'tugas_deadline'=>'required',
        ]);

        Tugas::where('tugas_id',$tugas_id)->update([
            'tugas_judul'=>$request->tugas_judul,
            'tugas_deskripsi'=>$request->tugas_deskripsi,
            'tugas_deadline'=>$request->tugas_deadline,
        ]);

        return redirect('/tugas/detail/'.$tugas_id);
    }

    public function delete($tugas_id){
        //baris ini perlu dibikin fungsi sendiri ga?
        $guru_id = Auth::user()->guru->id;
        $mapel_assoc_pengampu_id = Tugas::where('tugas_id',$tugas_id)->first();
        if(($mapel_assoc_pengampu_id == NULL) or ($guru_id != $mapel_assoc_pengampu_id->mapelassociation()->first()->pengampu_id)){    
            abort(404);
        }

        $to_be_deleted = Tugas::where('tugas_id',$tugas_id)->first();
        $mapel_assoc_id = $to_be_deleted->mapel_assoc_id;
        Tugas::where('tugas_id',$tugas_id)->delete();
        //Belum handle siswa yang udah upload tugas, waktu tugas dihapus, record upload tugas masih ada di db
        return redirect('/tugas/mapel/'.$mapel_assoc_id);
    }
    
}
