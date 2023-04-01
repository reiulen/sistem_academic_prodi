<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataSKController extends Controller
{
    public function index()
    {
        $dosen = [
            [
              "nama" => "SK MENGAJAR",
              "unduh" => "https://bit.ly/SK_MENGAJAR_PBSI"
            ],
            [
              "nama" => "SK PEMBIMBING SKRIPSI",
              "unduh" => "https://bit.ly/SK_PEMBIMBING_SKRIPSI_PBSI"
            ],
            [
              "nama" => "SK PENGUJI SKRIPSI",
              "unduh" => "https://bit.ly/SK-PENDADARAN"
            ],
            [
              "nama" => "BERITA ACARA UJIAN SKRIPSI",
              "unduh" => "https://bit.ly/Berita-Acara-Pendadaran"
            ]
        ];

        $mahasiswa = [
            [
              "nama" => "SK PEMBIMBING SKRIPSI",
              "unduh" => "https://bit.ly/SK_PEMBIMBING_SKRIPSI_PBSI"
            ],
            [
              "nama" => "SK PENGUJI SKRIPSI",
              "unduh" => "https://bit.ly/SK-PENDADARAN"
            ],
            [
              "nama" => "BERITA ACARA UJIAN SKRIPSI",
              "unduh" => "https://bit.ly/Berita-Acara-Pendadaran"
            ]
        ];

        if(Auth::user()->role == 2)
            $data = $dosen;
        else if(Auth::user()->role == 3)
            $data = $mahasiswa;
        else
            return abort(404);

        return view('data_sk.index', compact('data'));
    }
}
