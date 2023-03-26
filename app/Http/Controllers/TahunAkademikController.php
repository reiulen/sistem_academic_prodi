<?php

namespace App\Http\Controllers;

use App\Models\TypePage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tahun_akademik.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $data = TahunAkademik::find($request->id);
        if(isset($data)) {
            $validasi = Validator::make($input, [
                'semester' => 'required',
                'tahun_akademik' => 'required|unique:tahun_akademiks,tahun_akademik,'.$data->id,
            ]);

            if($validasi->fails())
                return response()->json([
                    'semester' => 'error',
                    'message' => $validasi->errors()->first()
                ]);

            $data->update($input);
        }else {
            $validasi = Validator::make($input, [
                'semester' => 'required',
                'tahun_akademik' => 'required|unique:tahun_akademiks,tahun_akademik',
            ]);

            if($validasi->fails())
                return response()->json([
                    'status' => 'error',
                    'message' => $validasi->errors()->first()
                ]);

            $data = TahunAkademik::create($input);
        }

        return response()->json([
            'status' => 'success',
            'message' => "Data $data->name berhasil disimpan" ,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TahunAkademik::find($id);
        if(empty($data))
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ]);

        $data->delete();

        return response()->json([
            'message' => "Data $data->name berhasil dihapus" ,
        ]);
    }


    public function dataTable(Request $request)
    {
        $data = TahunAkademik::select('id', 'tahun_akademik', 'semester', 'created_at')
                            ->latest();

        return DataTables::of($data)
                            ->addindexColumn()
                           ->addColumn('action', function($data) {
                                $action = "<div class='col-md-1'>
                                                    <button class='btn btn-none' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        <i class='fas fa-ellipsis-v'></i>
                                                    </button>
                                                    <div class='dropdown-menu dropdown-menu-right border-0' aria-labelledby='dropdownMenuButton'>
                                                        <div role='button' class='dropdown-item btnEdit' data-id='$data->id' data-name='$data->tahun_akademik' data-status='$data->semester'>
                                                            <i class='fas fa-pencil-alt text-success pr-1'></i>
                                                            Ubah
                                                        </div>
                                                        <div role='button' class='dropdown-item btn-hapus' data-id='$data->id' data-title='$data->tahun_akademik'>
                                                            <i class='fas fa-trash text-danger pr-1'></i>
                                                            Hapus
                                                        </div>
                                                    </div>
                                                </div>";
                                return $action;
                           })->rawColumns(['action'])
                           ->smart(true)
                           ->make(true);

    }
}
