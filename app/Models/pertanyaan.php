<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\test_description as Test;
use App\Models\pilihan_jawaban as Jawaban;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class pertanyaan extends Model
{
    use HasFactory;
    
    protected $table = "pertanyaans";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_test',
        'pertanyaan',
    ];

    public function test() : HasOne
    {
        return $this->hasOne(Test::class,'id','id_test');
    }

    public function jawaban() : HasMany
    {
        return $this->hasMany(Jawaban::class,'id_pertanyaan','id');
    }

}
