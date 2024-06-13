<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

// model
use App\Models\pertanyaan as Pertanyaan;
use App\Models\pilihan_summary as Summary;
use Illuminate\Database\Eloquent\Relations\HasMany;

class pilihan_jawaban extends Model
{
    use HasFactory;
    protected $table = "pilihan_jawabans";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_pertanyaan',
        'id_summary',
        'jawaban',
    ];

    public function pertanyaan() : HasOne
    {
        return $this->hasOne(Pertanyaan::class,'id','id_pertanyaan');
    }

    public function summary() : HasMany
    {
        return $this->hasMany(Summary::class,'id','id_summary');
    }
}
