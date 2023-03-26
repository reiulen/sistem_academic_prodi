<?php

namespace App\Providers;

use App\Models\TahunAkademik;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(empty(Session()->get('tahun_akademik_id')) && empty(Session()->get('tahun_akademik'))) {
            $tahun_akademik = TahunAkademik::latest()->first();
            if($tahun_akademik) {
                Session()->put('tahun_akademik_id', $tahun_akademik->id);
                Session()->put('tahun_akademik', $tahun_akademik->tahun_akademik);
            }
        }

        config(['app.locale' => 'id']);
	    Carbon::setLocale('id');

        $tahun_akademik = TahunAkademik::orderBy('tahun_akademik', 'DESC')
                                        ->get();
        View::share('tahun_akademik', $tahun_akademik);
    }
}
