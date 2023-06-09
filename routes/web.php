<?php

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DataSKController;
use App\Http\Controllers\SkripsiController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\SeminarSkripsiController;
use App\Http\Controllers\TextEditorController;
use App\Models\Pengumuman;

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
    return redirect()->route('dashboard');
});

$role = '';
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('admin')
->group(function () {
    Route::get('/dashboard', function () {
        $mahasiswa = Mahasiswa::select('id')->count();
        $dosen = Dosen::select('id')->count();
        $pengumuman = Pengumuman::where('status', 1)
                                  ->latest()
                                  ->get();
        return view('dashboard', compact('pengumuman','mahasiswa', 'dosen'));
    })->name('dashboard');

    Route::post('/changeTH', function(Request $request) {
        $tahun_akademik = TahunAkademik::find($request->tahun_akademik_id);
        if(empty($request->tahun_akademik_id) || empty($tahun_akademik))
            return back();

        Session()->put('tahun_akademik_id', $request->tahun_akademik_id);
        Session()->put('tahun_akademik', $tahun_akademik->tahun_akademik);
        return back();
    })->name('changeTH');

    Route::resource('/dosen', DosenController::class);
    Route::resource('/skripsi', SkripsiController::class);
    Route::get('/data-skripsi',[ SkripsiController::class, 'dataSkripsi'])->name('data-skripsi');
    Route::get('/skripsi/{id}/kartu-bimbingan', [SkripsiController::class, 'detailBimbingan'])->name('detailBimbingan');
    Route::post('/skripsi/{id}/kartu-bimbingan', [SkripsiController::class, 'store'])->name('detailBimbingan.store');
    Route::delete('/skripsi/{detail_id}/kartu-bimbingan/{id}', [SkripsiController::class, 'destroy'])->name('detailBimbingan.destroy');
    Route::get('/skripsi/{id}/kartu-bimbingan/create', [SkripsiController::class, 'create'])->name('kartu-bimbingan.create');
    Route::get('/skripsi/{id}/kartu-bimbingan/export', [SkripsiController::class, 'export'])->name('kartu-bimbingan.export');
    Route::post('/skripsi/{id}/kartu-bimbingan/dataTable', [SkripsiController::class, 'dataTable'])->name('kartu-bimbingan.dataTable');
    Route::resource('/seminar-skripsi', SeminarSkripsiController::class);
    Route::get('/detail-dosen', [SeminarSkripsiController::class, 'detailDosen'])->name('seminar-skripsi.detailDosen');
    Route::resource('/mahasiswa', MahasiswaController::class);
    Route::resource('/bimbingan', BimbinganController::class);
    Route::get('/bimbingan/export/data',[ BimbinganController::class, 'export'])->name('bimbingan.export');
    Route::resource('tahun-akademik', TahunAkademikController::class);
    Route::post('/tahun-akademik/dataTable', [TahunAkademikController::class, 'dataTable'])->name('tahun_akademik.dataTable');
    Route::resource('/admin', AdminController::class);
    Route::get('/data-sk',[ DataSKController::class, 'index'])->name('data-sk.index');
    Route::resource('/pengumuman', PengumumanController::class);

    Route::group(['prefix' => 'textEditor'], function() {
        Route::post('/uploadPhoto',  [TextEditorController::class, 'uploadPhoto'])->name('uploadPhoto');
        Route::post('/deletePhoto',  [TextEditorController::class, 'deletePhoto'])->name('deletePhoto');
    });

});
