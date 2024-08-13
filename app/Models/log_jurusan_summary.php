<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log_jurusan_summary extends Model
{
    use HasFactory;
    protected $table = "log_jurusan_summaries";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_jurusan',
        'id_summary',
    ];
}
