<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';

    protected $fillable = ['code', 'name', 'kode_database', 'description', 'type', 'bobot'];

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class);
    }

    public function nilaiBobot()
    {
        return $this->hasMany(NilaiBobot::class);
    }
}
