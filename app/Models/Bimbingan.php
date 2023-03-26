<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Bimbingan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('tahun_akademik_id', function (Builder $builder) {
            if (Session()->get('tahun_akademik_id', '')) {
                $builder->where('bimbingans.tahun_akademik_id', Session()->get('tahun_akademik_id', ''));
            }
        });
    }

    public function __construct(array $attributes = [])
    {
        $this->tahun_akademik_id = Session()->get('tahun_akademik_id', '');

        parent::__construct($attributes);
    }
}
