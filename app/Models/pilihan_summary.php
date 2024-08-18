<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


// model 
use App\Models\test_description as Test;
use App\Models\jurusan_universitas as Jurusan;


class pilihan_summary extends Model
{
    use HasFactory;
    
    protected $table ="pilihan_summaries";
    protected $primaryKey = "id";
    protected $fillable =[
        'nama_bakat',
        'singkatan',
        'keterangan',
        'id_test',
    ];

    public function test() : HasOne
    {
        return $this->hasOne(Test::class,'id','id_test');
    }


    public function jurusan() : BelongsToMany
    {
        return $this->belongsToMany(Jurusan::class,'log_jurusan_summaries','id_summary','id_jurusan');
    }
}
