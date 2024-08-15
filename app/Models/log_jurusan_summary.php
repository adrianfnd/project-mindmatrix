<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// model 
use App\Models\jurusan_universitas as Jurusan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class log_jurusan_summary extends Model
{
    use HasFactory;
    protected $table = "log_jurusan_summaries";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_jurusan',
        'id_summary',
    ];

    public function jurusan() : BelongsTo
    {
        return $this->belongsTo(Jurusan::class,'id_jurusan','id');
    }
}
