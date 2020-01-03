<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TugasUpload;
use App\Tugas;
use Auth;

class TugasUploadController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('siswa',['only' => [
            'uploadNew',
            'uploadUpdate',
        ]]);
        $this->middleware('guru',['only' => [
            'submisi',
            'detailSubmisi',
            'nilai',

        ]]);
    }

    public function uploadNew(Request $request, $tugas_id){
        $id = Auth::user()->siswa->id;
        $this->validate($request,[
            'upload_file'=>'required|mimetypes:application/pdf|max:10000',
        ]);

        $file = $request->file('upload_file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $upload_target = 'upload_tugas_folder';
        $file->move($upload_target,$nama_file);

        TugasUpload::create([
            'upload_file'=>$nama_file,
            'siswa_id'=>$id,
            'tugas_id'=>$tugas_id,
        ]);

        return redirect()->back();
    }

    public function uploadUpdate(Request $request, $tugas_id){
        $id = Auth::user()->siswa->id;
        $this->validate($request,[
            'upload_file'=>'required|mimetypes:application/pdf|max:10000',
        ]);

        $file = $request->file('upload_file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $upload_target = 'upload_tugas_folder';
        $file->move($upload_target,$nama_file);

        //TugasUpload::where('tugas_id',$tugas_id)->where('siswa_id',$id)->update([
        TugasUpload::where([
            ['tugas_id','=',$tugas_id],
            ['siswa_id','=',$id],
        ])->update([
            'upload_file'=>$nama_file,
        ]);

        return redirect()->back();
    }

    public function submisi($tugas_id){
        $guru_id = Auth::user()->guru->id;
        $mapel_assoc_pengampu_id = Tugas::where('tugas_id',$tugas_id)->first();
        if(($mapel_assoc_pengampu_id == NULL) or ($guru_id != $mapel_assoc_pengampu_id->mapelassociation()->first()->pengampu_id)){    
            abort(404);
        }
        
        $list_submisi = TugasUpload::where('tugas_id',$tugas_id)->get();
        $list_siswa_submit = array();
        foreach($list_submisi as $submisi){
            array_push($list_siswa_submit,$submisi->siswa_id);
        };
        $list_siswa = Tugas::where('tugas_id',$tugas_id)->first()->mapelassociation->kelas->first()->siswa->whereNotIn('id',$list_siswa_submit);

        return view('tugas_upload_submisi',[
            'list_siswa'=>$list_siswa,
            'list_submisi'=>$list_submisi,
            ]);
    }

    public function detailSubmisi($upload_id){
        //verifikasi upload id dengan id guru, idk gabisa dipake foreign langsung dari model TugasUpload
        //masih bisa dipersingkat
        $tugas_id = TugasUpload::select('tugas_id')->where('upload_id',$upload_id)->first();
        
        if ($tugas_id == NULL){
            abort(404);
        } else {
            $guru_id = Auth::user()->guru->id;
            $mapel_assoc_id = Tugas::where('tugas_id',$tugas_id->tugas_id)->first()->mapelassociation->pengampu_id;
            if ($guru_id != $mapel_assoc_id){
                abort(404);
            }
        }

        $submisi = TugasUpload::where('upload_id',$upload_id)->first();
        return view('tugas_upload_detail',['submisi'=>$submisi]);
    }

    // !!! VULN IDOR/INTERCEPT !!!
    public function nilai($upload_id, Request $request){
        $tugas_id = TugasUpload::select('tugas_id')->where('upload_id',$upload_id)->first()->toArray();
        $tugas_id = $tugas_id['tugas_id'];
        $guru_id = Auth::user()->guru->id;
        $mapel_assoc_pengampu_id = Tugas::where('tugas_id',$tugas_id)->first();
        if(($mapel_assoc_pengampu_id == NULL) or ($guru_id != $mapel_assoc_pengampu_id->mapelassociation()->first()->pengampu_id)){    
            abort(404);
        }
        
        $this->validate($request,[
            'upload_nilai'=>'required|integer',
            'upload_komentar'=>'nullable|string',
        ]);

        TugasUpload::where('upload_id',$upload_id)->update([
            'upload_nilai'=>$request->upload_nilai,
            'upload_komentar'=>$request->upload_komentar,
        ]);
        return redirect('/tugas/upload/submisi/'.$tugas_id['tugas_id']);
    }
    
}
