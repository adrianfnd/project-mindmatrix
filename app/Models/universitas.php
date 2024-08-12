<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


// model 
use App\Models\jurusan_universitas as Jurusan;


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

    public function jurusan() : BelongsToMany
    {
        return $this->belongsToMany(Jurusan::class,'log_jurusan_universitas','id_universitas','id_jurusan');
    }
}
