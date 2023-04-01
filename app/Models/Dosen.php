<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['nama_dosen'];

    public function getNamaDosenAttribute()
    {
        return $this->gelar_depan . ' ' . $this->nama . ' ' . $this->gelar_belakang;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function SeminarSkripsi()
    {
        return $this->hasMany(SeminarSkripsi::class, 'dosen_id', 'id');
    }
}
