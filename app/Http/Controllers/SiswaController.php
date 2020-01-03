<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Siswa;
use App\Kelas;

class SiswaController extends Controller
{
    public function __construct(){
        $this->middleware('siswa', ['except' => ['profil']]);
    }

    public function index(){
        $user_id = Auth::user()->id;
        //script sampah, belajar join. fungsi toArray kenapa mabok, pokok mlaku sek
        
        $current = Siswa::where('user_id',$user_id)->select('kelas_sekarang')->get()->toArray();
        if ($current != NULL){
            $current = $current[0]['kelas_sekarang'];
            $kelas = Kelas::select('ruangan','tingkat')->where('id',$current)->get()->toArray();
            $kelas = $kelas[0]['tingkat'] . "  " . $kelas[0]['ruangan'];
            //Raw Query buat inner joinnya kek gini
                // SELECT nama_kelas FROM kelas
                // INNER JOIN siswa
                // ON kelas.id = (SELECT kelas_sekarang FROM siswa WHERE user_id = 3)
            return view('siswa_dashboard',[
                'user_id'=>$user_id, 
                'role'=>'siswa', 
                'kelas'=>$kelas,
                'kelas_id'=>$current,
                ]);
        } else {
            return view('siswa_dashboard',['user_id'=>$user_id, 'role'=>'siswa']);
        }
        
    }

    public function profil($user_id){
        $siswa = Siswa::where('user_id',$user_id)->first();
        if($siswa == NULL){
            $message = 'Profil kosong';
            return view('profile_display',['message'=>$message,'role'=>'siswa']);
        } else {
            return view('profile_display',['profil'=>$siswa,'role'=>'siswa']);
        }    
    }

    public function create(){
        $creds = Auth::user()->id;
        $siswa = Siswa::where('user_id',$creds)->first();
        $list_kelas = Kelas::all();
        if ($siswa != NULL){
            return $this->profil($creds);
        } else {
            return view('profile_create',['role'=>'siswa','list_kelas'=>$list_kelas]);
        }        
    }

    public function createProcess(Request $request){
        $creds = Auth::id();
        // $guru = Guru::where('user_id',$creds)->first();
        $this->validate($request,[
            'nama_lengkap' => 'required|max:100|string',
            'NIS' => 'required|integer',
            //[1]sementara, kalo fitur admin udah jadi, yang assign kelas si admin
            'kelas_sekarang' => 'required',
        ]); 
        Siswa::create([
            'user_id' => $creds,
            'nama_lengkap' => $request->nama_lengkap,
            'NIS' => $request->NIS,
            //[1]
            'kelas_sekarang' => $request->kelas_sekarang,
        ]);
        return redirect('/siswa');
    }

    public function edit(){
        $creds = Auth::id();
        $siswa = Siswa::where('user_id',$creds)->first();    
        $list_kelas = Kelas::all();
        if ($siswa == NULL){
            return $this->create();
        } else {
            return view('profile_edit',['profil'=>$siswa,'role'=>'siswa','list_kelas'=>$list_kelas]);
        }
    }

    public function editProcess(Request $request){
        $creds = Auth::id();
        $siswa = Siswa::where('user_id',$creds)->first();
        $this->validate($request,[
            'nama_lengkap' => 'required|max:100|string',
            'NIS' => 'required',
            //[1]
            'kelas_sekarang' => 'required',
        ]); 
        Siswa::where('user_id',$creds)->update([
            'nama_lengkap' => $request->nama_lengkap,
            'NIS' => $request->NIS,
            //[1]
            'kelas_sekarang' => $request->kelas_sekarang,
        ]);
        return redirect('/siswa');
    }
}
