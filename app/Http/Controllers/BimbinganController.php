<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Bimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class BimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Bimbingan::with('dosen');

        if(Auth::user()->role == 2)
            $data = $data->where('dosen_id', Auth::user()->dosen->id);

        $data = $data->latest()->get();

        return view('bimbingan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role != 2)
            return abort(404);
        return view('bimbingan.create-update');
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
            'kelas' => 'required',
            'topik' => 'required',
        ]);

        $input['dosen_id'] = Auth::user()->dosen->id ?? '-';
        $bimbingan = Bimbingan::create($input);

        return redirect(route('bimbingan.index'))
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role != 2)
            return abort(404);

        $data = new Bimbingan;

        if(Auth::user()->role == 2)
            $data = $data->where('dosen_id', Auth::user()->dosen->id);

        $data = $data->findOrFail($id);

        return view('bimbingan.create-update', compact('data'));
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
        $data = Bimbingan::findOrFail($id);
         $request->validate([
            'kelas' => 'required',
            'topik' => 'required',
        ]);

        $data->update($input);

        return redirect(route('bimbingan.index'))
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
        $data = Bimbingan::findorFail($id);

        $data->delete();

        return redirect(route('bimbingan.index'))
                        ->with('success', 'Data berhasil dihapus');
    }

    public function export()
    {
        $data = Bimbingan::with('dosen')
                            ->latest()
                            ->get();

        // return view('bimbingan.export', compact('data'));
        return response(view('bimbingan.export', compact('data')))
                    ->header('Content-Type', 'application/vnd-ms-excel')
                    ->header('Content-Disposition', 'attachment; filename="' . 'Bimbingan Kelas ('.date('d F Y').').xls"');
    }

}
