<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\pertanyaan as Pertanyaan;
use App\Models\pilihan_summary as Summary;
use App\Models\log_test_user as Log_Test;

class test_description extends Model
{
    use HasFactory;

    protected $table = "test_descriptions";
    protected $primarykey = "id";
    protected $fillable = [
        'nama_test',
        "desc_test",
    ];

    public function pertanyaan(): HasMany
    {
        return $this->hasMany(Pertanyaan::class,'id_test','id');
    }
    public function summary(): HasMany
    {
        return $this->hasMany(Summary::class,'id_test','id');
    }

    public function log_test(): HasMany
    {
        return $this->hasMany(Log_Test::class,'id_test','id');
    }
}
