<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class universitas extends Model
{
    use HasFactory;
    protected $table = "universitas";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_kampus',
        'image_logo',
        'akreditasi',
        'alamat',
    ];
}
