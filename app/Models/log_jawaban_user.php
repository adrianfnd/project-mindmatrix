<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

// model
use App\Models\log_test_user as Log_test;
use App\Models\pilihan_jawaban as Pertanyaan;

class log_jawaban_user extends Model
{
    use HasFactory;
    protected $table = "log_jawaban_users";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_log',
        'id_pertanyaan',
        'jawaban',
    ];

    public function log_test() : BelongsTo
    {
        return $this->belongsTo(Log_test::class,'id','id_log');

    }

    public function pertanyaan() : HasOne
    {
        return $this->hasOne(Pertanyaan::class,'id','id_pertanyaan');
    }
}
