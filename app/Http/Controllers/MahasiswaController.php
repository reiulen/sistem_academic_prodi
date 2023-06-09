<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\SeminarSkripsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 1) {
            $data = Mahasiswa::latest()->get();
            return view('mahasiswa.index', compact('data'));
        }else {
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

        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create-update');
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
            'nim' => 'required|unique:mahasiswas|unique:users,username',
            'nama' => 'required',
            'password' => 'required|min:6',
            'status' => 'required',
        ]);

        $user = User::create([
            'username' => $request->nim,
            'name' => $request->nama,
            'password' => Hash::make($request->password),
            'role' => 3
        ]);

        $input['user_id'] = $user->id;
        $mahasiswa = Mahasiswa::create($input);

        return redirect(route('mahasiswa.index'))
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
        $data = Mahasiswa::findOrFail($id);

        return view('mahasiswa.create-update', compact('data'));
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
        $data = Mahasiswa::with('user')
                        ->findOrFail($id);

        $request->validate([
            'nim' => 'required|unique:mahasiswas,id,'.$id . '|unique:users,mahasiswa,' .  $data->user->id ?? 0,
            'nama' => 'required',
            'status' => 'required',
        ]);

        $password = $data->user->password;
        if($request->password) {
            $request->validate([
                'password' => 'min:6'
            ]);
            $password = Hash::make($request->password);
        }

        $data->user->update([
            'username' => $request->nim,
            'name' => $request->nama,
            'passwrod' => $password,
        ]);

        $data->update($input);

        return redirect(route('mahasiswa.index'))
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
        $data = Dosen::findorFail($id);
        $data->user->delete();
        $data->delete();

        return redirect(route('mahasiswa.index'))
                        ->with('success', 'Data berhasil dihapus');
    }

}
