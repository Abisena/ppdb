<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppdb extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'nisn',
        'kelamin',
        'no_hp',
        'no_hp_ayah',
        'no_hp_ibu',
        'asal_sekolah',
        'asal_sekolah_text',
        'role',
    ];
}
