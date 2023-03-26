<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
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
        $data = Dosen::latest()->get();
        return view('dosen.index', compact('data'));
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
            'nip_niy' => 'required|unique:dosens',
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
            'nip_niy' => 'required|unique:dosens,id,' . $id,
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
