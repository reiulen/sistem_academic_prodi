<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class KartuBimbinganSkripsi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('tahun_akademik_id', function (Builder $builder) {
            if (Session()->get('tahun_akademik_id', '')) {
                $builder->where('kartu_bimbingan_skripsis.tahun_akademik_id', Session()->get('tahun_akademik_id', ''));
            }
        });
    }

    public function __construct(array $attributes = [])
    {
        $this->tahun_akademik_id = Session()->get('tahun_akademik_id', '');

        parent::__construct($attributes);
    }
}
