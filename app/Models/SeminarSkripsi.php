<?php

namespace App\Models;

use App\Models\KartuBimbinganSkripsi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeminarSkripsi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }

    public function kartuBimbingan()
    {
        return $this->hasMany(KartuBimbinganSkripsi::class, 'seminar_skripsi_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('tahun_akademik_id', function (Builder $builder) {
            if (Session()->get('tahun_akademik_id', '')) {
                $builder->where('seminar_skripsis.tahun_akademik_id', Session()->get('tahun_akademik_id', ''));
            }
        });
    }

    public function __construct(array $attributes = [])
    {
        $this->tahun_akademik_id = Session()->get('tahun_akademik_id', '');

        parent::__construct($attributes);
    }

}
