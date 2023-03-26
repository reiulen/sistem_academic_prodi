<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\SeminarSkripsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\KartuBimbinganSkripsi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class SkripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = SeminarSkripsi::with('mahasiswa', 'dosen');

        if($user->role == 3)
            $data = $data->where('mahasiswa_id', ($user->mahasiswa->id ?? 0));
        elseif($user->role == 2)
            $data = $data->where('dosen_id', ($user->dosen->id ?? 0));

        $data = $data->where('status', 1)
                    ->latest()
                    ->get();

        return view('skripsi.index', compact('data'));
    }

    public function detailBimbingan(Request $request, $id)
    {
        $data = SeminarSkripsi::with('kartuBimbingan', 'dosen', 'mahasiswa')
                               ->findOrFail($id);
        $kartu_bimbingan = $data->kartuBimbingan ?? [];
        return view('skripsi.detail_kartu', compact('data', 'kartu_bimbingan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $input = $request->all();
        $input['seminar_skripsi_id'] = $id;

        $data = KartuBimbinganSkripsi::find($request->id);
        if(isset($data)) {
            $validasi = Validator::make($input, [
                'bab' => 'required',
                'evaluasi' => 'required',
            ]);

            if($validasi->fails())
                return response()->json([
                    'status' => 'error',
                    'message' => $validasi->errors()->first()
                ]);

            $data->update($input);
        }else {
            $validasi = Validator::make($input, [
                'bab' => 'required',
                'evaluasi' => 'required',
            ]);

            if($validasi->fails())
                return response()->json([
                    'status' => 'error',
                    'message' => $validasi->errors()->first()
                ]);

            $data = KartuBimbinganSkripsi::create($input);
        }

        return response()->json([
            'status' => 'success',
            'message' => "Data $data->bab berhasil disimpan" ,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($detail_id, $id)
    {
        $data = KartuBimbinganSkripsi::find($id);
        if(empty($data))
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ]);

        $data->delete();

        return response()->json([
            'message' => "Data $data->evaluasi berhasil dihapus" ,
        ]);
    }

    public function dataTable(Request $request, $id)
    {
        $data = KartuBimbinganSkripsi::select('id', 'bab', 'evaluasi', 'created_at')
                                    ->where('seminar_skripsi_id', $id)
                                    ->latest();

        return DataTables::of($data)
                            ->addindexColumn()
                            ->addColumn('tanggal', function($data) {
                                return date('d F Y H:i:s', strtotime($data->created_at));
                            })
                           ->addColumn('action', function($data) {
                                $action = "<div class='d-flex align-items-center' style='gap: 5px'>
                                                    <div role='button' class='btn btn-primary btn-sm btnEdit' data-id='$data->id' data-bab='$data->bab' data-evaluasi='$data->evaluasi'>
                                                        <i class='fas fa-pencil-alt text-white'></i>
                                                    </div>
                                                    <div role='button' class='btn btn-danger btn-sm btn-hapus' data-id='$data->id' data-title='$data->evaluasi'>
                                                        <i class='fas fa-trash-alt text-white'></i>
                                                    </div>
                                                </div>";
                                if(Auth::user()->role != 2)
                                    $action = '';

                                return $action;
                           })->rawColumns(['action', 'tanggal'])
                           ->smart(true)
                           ->make(true);

    }

    public function export($id)
    {
        $data = SeminarSkripsi::with('kartuBimbingan', 'dosen', 'mahasiswa')
                                ->findOrFail($id);
        $kartu_bimbingan = $data->kartuBimbingan ?? [];

        return response(view('skripsi.export', compact('data', 'kartu_bimbingan')))
                    ->header('Content-Type', 'application/vnd-ms-excel')
                    ->header('Content-Disposition', 'attachment; filename="' . 'Kartu Bimbingan Skripsi ('.date('d F Y').').xls"');
    }

}
