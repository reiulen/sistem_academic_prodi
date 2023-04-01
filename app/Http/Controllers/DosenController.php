<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\SeminarSkripsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 1) {
            $data = Dosen::latest()->get();
            return view('dosen.index', compact('data'));
        }elseif(Auth::user()->role == 2) {
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
        return view('dosen.create-update');
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
            'nip_niy' => 'required|unique:dosens|unique:users,username',
            'nama' => 'required',
            'password' => 'required|min:6',
            'rumpun' => 'required',
            'jabatan' => 'required',
            'status_mengajar' => 'required'
        ]);

        $user = User::create([
            'username' => $request->nip_niy,
            'name' => $request->nama,
            'password' => Hash::make($request->password),
            'role' => 2
        ]);

        $input['user_id'] = $user->id;
        $dosen = Dosen::create($input);

        return redirect(route('dosen.index'))
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
        $data = Dosen::findOrFail($id);

        return view('dosen.create-update', compact('data'));
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
        $data = Dosen::with('user')
                        ->findOrFail($id);
        $request->validate([
            'nip_niy' => 'required|unique:dosens,id,' . $id . '|unique:users,username,' . $data->user->id,
            'nama' => 'required',
            'rumpun' => 'required',
            'jabatan' => 'required',
            'status_mengajar' => 'required'
        ]);

        $password = $data->user->password;
        if($request->password) {
            $request->validate([
                'password' => 'min:6'
            ]);
            $password = Hash::make($request->password);
        }

        $data->user->update([
            'username' => $request->nip_niy,
            'name' => $request->nama,
            'passwrod' => $password,
        ]);

        $data->update($input);

        return redirect(route('dosen.index'))
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
        $data = Dosen::with('user')
                        ->findorFail($id);

        $data->user->delete();
        $data->delete();

        return redirect(route('dosen.index'))
                        ->with('success', 'Data berhasil dihapus');
    }

}
