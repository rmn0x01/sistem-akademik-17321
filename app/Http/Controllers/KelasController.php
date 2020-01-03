<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Guru;
use App\Siswa;
use App\Jadwal;
use Auth;

class KelasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('guru',['only'=>[
            'index',
            'detailPeek',
            'jadwalPeek',
        ]]);
    }

    //gakepake ini fungsi index
    public function index(){
        $list_kelas = Kelas::all();
        return view('kelas_list',['list_kelas'=>$list_kelas]);
    }

    public function detailPeek($id){
        $kelas = Kelas::where('id',$id)->first();
        if($kelas == NULL){
            abort(404);
        }
        return view('kelas_peek',['kelas'=>$kelas]);
    }

    public function detail(){
        $user_id = Auth::id();
        $kelas = Siswa::where('user_id',$user_id)->first()->kelas;
        // $guru = Guru::select('nama_depan','nama_belakang','user_id')->where('id',$kelas->wali_kelas)->first();
        //$list_siswa = Siswa::where('kelas_sekarang',$kelas->id)->get();
        return view('kelas_detail',['kelas'=>$kelas]);
    }

    public function jadwalPeek($id){
        $kelas = Kelas::where('id',$id)->first();
        if($kelas == NULL){
            abort(404);
        }
        $nama_kelas = $kelas->tingkat . " " . $kelas->ruangan;
        $kelas_id = $kelas->mapelassociation()->select('id')->get()->toArray();
        $mapel_assoc_id = array();
        foreach($kelas_id as $kelas){
            array_push($mapel_assoc_id,$kelas['id']);
        };
        $list_jadwal = Jadwal::wherein('mapel_assoc_id',$mapel_assoc_id)->get();
        return view('kelas_jadwal_peek',['list_jadwal'=>$list_jadwal,'nama_kelas'=>$nama_kelas]);
    }

    public function getJadwal(){
        $user_id = Auth::id();
        $kelas = Siswa::where('user_id',$user_id)->first()->kelas;
        $nama_kelas = $kelas->tingkat . " " . $kelas->ruangan;
        $kelas_id = $kelas->mapelassociation()->select('id')->get()->toArray();
        $mapel_assoc_id = array();
        foreach($kelas_id as $kelas){
            array_push($mapel_assoc_id,$kelas['id']);
        };
        $list_jadwal = Jadwal::wherein('mapel_assoc_id',$mapel_assoc_id)->get();
        return view('kelas_jadwal',['list_jadwal'=>$list_jadwal,'nama_kelas'=>$nama_kelas]);
    }

    public function listSiswa($id){
        $list_siswa = Kelas::where('id',$id)->first()->siswa;
        return view('kelas_siswa',['list_siswa'=>$list_siswa]);
    }
}
