<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusan_universitas extends Model
{
    use HasFactory;
    protected $table = "jurusan_universitas";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_jurusan',
        'status',
    ];
}
