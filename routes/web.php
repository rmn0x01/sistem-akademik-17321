<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin','AdminController@index')->name('admin');
//Guru
Route::get('/guru','GuruController@index')->name('guru');
Route::get('/guru/profil/{id}','GuruController@profil')->name('guru_profil');
Route::get('/guru/edit/profil','GuruController@edit')->name('guru_edit');
Route::post('/guru/editprocess/profil','GuruController@editProcess')->name('guru_processedit');
Route::get('/guru/create','GuruController@create')->name('guru_create');
Route::post('/guru/createprocess/profil','GuruController@createProcess')->name('guru_processcreate');
Route::get('/guru/jadwal','GuruController@getJadwal')->name('guru_jadwal');
Route::get('/guru/mapel','GuruController@getMapel')->name('guru_mapel');
//Siswa
Route::get('/siswa','SiswaController@index')->name('siswa');
Route::get('/siswa/profil/{id}','SiswaController@profil')->name('siswa_profil');
Route::get('/siswa/edit/profil','SiswaController@edit')->name('siswa_edit');
Route::post('/siswa/editprocess/profil','SiswaController@editProcess')->name('siswa_processedit');
Route::get('/siswa/create','SiswaController@create')->name('siswa_create');
Route::post('/siswa/createprocess/profil','SiswaController@createProcess')->name('siswa_processcreate');
//Kelas
Route::get('/kelas/full','KelasController@index')->name('kelas');
Route::get('/kelas','KelasController@detail')->name('kelas_detail');
Route::get('/kelas/peek/{id}','KelasController@detailPeek')->name('kelas_peek');
Route::get('/kelas/jadwal','KelasController@getJadwal')->name('kelas_jadwal');
Route::get('kelas/jadwal/peek/{id}','KelasController@jadwalPeek')->name('kelas_jadwal_peek');
Route::get('/kelas/siswa/{id}','KelasController@listSiswa')->name('kelas_siswa');
//Mapel
Route::get('/mapel','MapelController@index')->name('mapel');
Route::get('/mapel/create','MapelController@createMapel')->name('mapel_create');
Route::post('/mapel/create/process','MapelController@processCreateMapel')->name('mapel_create_process');
Route::get('/mapel/edit/{id}','MapelController@editMapel')->name('mapel_edit');
Route::post('/mapel/process/edit','MapelController@processEditMapel')->name('mapel_edit_process');
// Route::get('/mapel/delete/{id}','MapelController@deleteMapel')->name('mapel_delete'); masih ngebug
//MapelAssoc
Route::get('/mapelassoc','MapelAssociationController@index')->name('mapel_assoc');
Route::get('/mapelassoc/create','MapelAssociationController@create')->name('mapel_assoc_create');
Route::post('/mapelassoc/create/process','MapelAssociationController@processCreate')->name('mapel_assoc_create_process');
Route::get('/mapelassoc/edit/{id}','MapelAssociationController@edit')->name('mapel_assoc_edit');
Route::post('/mapelassoc/edit/process','MapelAssociationController@processEdit')->name('mapel_assoc_edit_process');
Route::get('/mapelassoc/delete/{id}','MapelAssociationController@delete')->name('mapel_assoc_delete');
//Jadwal
Route::get('/jadwal','JadwalController@index')->name('jadwal'); //TODO, Jadwal Management Dashboard for Admin
Route::get('/jadwal/detail/{id}','JadwalController@detail')->name('jadwal_detail');
Route::post('/jadwal/add/process','JadwalController@addProcess')->name('jadwal_add');
Route::get('/jadwal/delete/{id}','JadwalController@delete')->name('jadwal_delete');
//Materi
Route::get('/materi','MateriController@index')->name('materi');
Route::get('/materi/mapel/{mapel_id}/{tingkat}','MateriController@materiMapel')->name('materi_mapel');
Route::get('/materi/add/{mapel_id}/{tingkat}','MateriController@add')->name('materi_add');
Route::post('/materi/add/process','MateriController@addProcess')->name('materi_add_process');
Route::get('/materi/detail/{id}','MateriController@detailMateri')->name('materi_detail');
Route::get('/materi/edit/{id}','MateriController@edit')->name('materi_edit');
Route::post('/materi/edit/process','MateriController@editProcess')->name('materi_edit_process');
Route::get('/materi/delete/{id}','MateriController@delete')->name('materi_delete');
//Tugas
Route::get('/tugas/kelas','TugasController@getTugasKelas')->name('tugas_kelas');
Route::get('/tugas/mapel/{mapel_assoc_id}','TugasController@getTugasMapel')->name('tugas_mapel');
Route::get('/tugas/detail/{tugas_id}','TugasController@getDetailTugas')->name('tugas_detail');
Route::get('/tugas/add/','TugasController@addTugas')->name('tugas_add');
Route::post('/tugas/add/process','TugasController@addProcess')->name('tugas_add_process');
Route::get('/tugas/edit/{tugas_id}','TugasController@edit')->name('tugas_edit');
Route::post('/tugas/edit/process/{tugas_id}','TugasController@editProcess')->name('tugas_edit_process');
Route::get('/tugas/delete/{tugas_id}','TugasController@delete')->name('tugas_delete');
//TugasUpload
Route::post('/tugas/upload/{tugas_id}','TugasUploadController@uploadNew')->name('upload_tugas_baru');
Route::post('/tugas/upload/update/{tugas_id}','TugasUploadController@uploadUpdate')->name('upload_tugas_update');
Route::get('/tugas/upload/submisi/{tugas_id}','TugasUploadController@submisi')->name('upload_submisi');
Route::get('/tugas/upload/siswa/{upload_id}','TugasUploadController@detailSubmisi')->name('upload_submisi_detail');
Route::post('/tugas/upload/nilai/{upload_id}','TugasUploadController@nilai')->name('upload_tugas_nilai');

