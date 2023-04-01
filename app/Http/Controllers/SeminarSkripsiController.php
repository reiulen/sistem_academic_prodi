<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SeminarSkripsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SeminarSkripsiController extends Controller
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
            $data = $data->where('mahasiswa_id', ($user->mahasiswa->id ?? 0))
                        ->where('status', 1);

        $data = $data->latest()->get();

        if($user->role == 1) {
            return view('seminar_skripsi.index', compact('data'));
        }elseif($user->role == 3) {
            return view('seminar_skripsi.mahasiswa.index', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $dosen = Dosen::orderBy('nama', 'ASC')->get();
        $data = SeminarSkripsi::where('mahasiswa_id', ($user->mahasiswa->id ?? 0))
                                ->where('status', 1)
                                ->count();
        if($data > 2)
            return abort(404);

        return view('seminar_skripsi.mahasiswa.create-update', compact('dosen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            "dosen_id" => 'required',
            "rumpun" => 'required',
            "judul" => 'required',
            'tipe_seminar' => 'required',
            'doc_proposal' =>  'required|file|mimes:pdf,jpg,jpeg,png,xls,pptx,docx|max:2048',
        ]);

        $input['mahasiswa_id'] = Auth::user()->mahasiswa->id ?? 0;
        $input['doc_proposal'] = upload_file($request->file('doc_proposal'), 'doc-proposal', "doument");
        $input['type_file'] = $request->file('doc_proposal')->getClientOriginalExtension();
        $seminar_skripsi = SeminarSkripsi::create($input);

        return redirect(route('seminar-skripsi.index'))
                ->with('success', 'Data berhasil disimpan');
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
        $data = SeminarSkripsi::with('dosen')
                                ->findOrFail($id);
        $dosen = Dosen::orderBy('nama', 'ASC')
                        ->get();

        return view('seminar_skripsi.mahasiswa.create-update', compact('data', 'dosen'));
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
        $input = $request->all();
        $data = SeminarSkripsi::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'status' => 'required',
        ]);

        $data->update($input);

        if(Auth::user()->role == 2)
            $route = route('skripsi.index');
        else
            $route = route('seminar-skripsi.index');

        return redirect($route)
                ->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SeminarSkripsi::findorFail($id);
        $data->delete();

        return redirect(route('seminar-skripsi.index'))
                        ->with('success', 'Data berhasil dihapus');
    }

    public function detailDosen()
    {
        $dosen = Dosen::with('SeminarSkripsi')
                        ->orderBy('nama', 'ASC')->get();
        return view('seminar_skripsi.detail_dosen', compact('dosen'));
    }

}
