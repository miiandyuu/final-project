<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';

    protected $fillable = ['code', 'code_saham', 'name_saham'];

    public function nilaiBobot()
    {
        return $this->hasMany(NilaiBobot::class);
    }
}
