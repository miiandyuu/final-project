<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';

    protected $fillable = ['code', 'kode_database'];

    public function nilaiBobot()
    {
        return $this->hasMany(NilaiBobot::class);
    }
}
