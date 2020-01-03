<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use App\Guru;
use App\User;
use App\Jadwal;
use App\MapelAssociation;


class GuruController extends Controller
{
    public function __construct(){
        $this->middleware('guru', ['except' => ['profil']]);
    }

    public function index(){
        $user_id = Auth::user()->id;
        return view('guru_dashboard',['user_id'=>$user_id,'role'=>'guru']);
    }

    public function profil($user_id){
        $guru = Guru::where('user_id',$user_id)->first();
        if($guru == NULL){
            $message = 'Profil kosong';
            return view('profile_display',['message'=>$message,'role'=>'guru']);
        } else {
            return view('profile_display',['profil'=>$guru,'role'=>'guru']);
        }    
    }

    public function create(){
        $creds = Auth::user()->id;
        $guru = Guru::where('user_id',$creds)->first();
        if ($guru != NULL){
            return $this->profil($creds);
        } else {
            return view('profile_create',['role'=>'guru']);
        }        
    }

    public function createProcess(Request $request){
        $creds = Auth::id();
        // $guru = Guru::where('user_id',$creds)->first();
        $this->validate($request,[
            'nama_depan' => 'required|max:100|string',
            'nama_belakang' => 'string',
            'NIP' => 'required|string',
            'no_hp' => 'required|string',
            'tanggal_lahir' => 'required',
        ]); 
        Guru::create([
            'user_id' => $creds,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'NIP' => $request->NIP,
            'no_hp' => $request->no_hp,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);
        return redirect('/guru');
    }


    public function edit(){
        $creds = Auth::id();
        $guru = Guru::where('user_id',$creds)->first();    
        if ($guru == NULL){
            return $this->create();
        } else {
            return view('profile_edit',['profil'=>$guru,'role'=>'guru']);
        }
        
    }

    public function editProcess(Request $request){
        $creds = Auth::id();
        $guru = Guru::where('user_id',$creds)->first();
        $this->validate($request,[
            'nama_depan' => 'required|max:100|string',
            'nama_belakang' => 'string',
            'NIP' => 'required|integer',
            'no_hp' => 'required|integer',
            'tanggal_lahir' => 'required',
        ]); 
        Guru::where('user_id',$creds)->update([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'NIP' => $request->NIP,
            'no_hp' => $request->no_hp,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);
        return redirect('/guru');
    }    

    public function getJadwal(){
        $user_id = Auth::user()->id;
        $guru_id = Guru::where('user_id',$user_id)->first();
        if ($guru_id == NULL){
            return view('guru_jadwal',['list_jadwal'=>NULL]);
        } else {
            $guru_id=$guru_id->mapelassociation()->select('id')->get()->toArray();
            $mapel_assoc_id = array();
            foreach($guru_id as $guruu){
                array_push($mapel_assoc_id,$guruu['id']);
            };
            $list_jadwal = Jadwal::wherein('mapel_assoc_id',$mapel_assoc_id)->get();
            return view('guru_jadwal',['list_jadwal'=>$list_jadwal]);
        }
    }

    public function getMapel(){
        $id = Auth::user()->guru;
        if($id == NULL){
            return redirect('/guru/edit/profil');
        }
        $id = $id->id;
        $list_mapel = MapelAssociation::where('pengampu_id',$id)->get();
        return view('guru_mapel',['list_mapel'=>$list_mapel]);
    }
   
}
