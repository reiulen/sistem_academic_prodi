<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pengumuman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;



class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengumuman::latest()->get();
        return view('pengumuman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengumuman.create-update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required'
        ]);

        try {
            $input = $request->all();
            if($request->hasFile('image')){
                $input['image'] = upload_file($request->file('image'), 'Pengumuman', Str::slug($request->title));
            }
            $input['slug'] = Str::slug($request->title);

            Pengumuman::create($input);

            return redirect(route('pengumuman.index'))
                        ->with('success', 'Pengumuman berhasil ditambahkan');
        }catch(\Exception $e) {
            return back()
                    ->with('error', $e->getMessage())
                    ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pengumuman::where('slug', $id)
                            ->firstOrFail();
        return view('pengumuman.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pengumuman::findOrFail($id);

        return view('pengumuman.create-update', compact('data'));
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required'
        ]);

        $data = Pengumuman::findOrFail($id);

        try {
            $input = $request->all();
            if($request->hasFile('image')){
                if(isset($data->image)) File::delete($data->image);
                $input['image'] = upload_file($request->file('image'), 'Pengumuman', Str::slug($request->title));
            }
            $input['slug'] = Str::slug($request->title);

            $data->update($input);

            return redirect(route('pengumuman.index'))
                        ->with('success', 'Pengumuman berhasil diubah');
        }catch(\Exception $e) {
            return back()
                    ->with('error', $e->getMessage())
                    ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pengumuman::findOrFail($id);
        if($data->image)
            File::delete($data->image);

        $data->delete();

        return redirect(route('mahasiswa.index'))
                        ->with('success', "Data $data->title berhasil dihapus");
    }

}
