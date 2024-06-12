<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test_description extends Model
{
    use HasFactory;

    protected $table = "test_descriptions";
    protected $primarykey = "id";
    protected $fillable = [
        'nama_test',
        "desc_test",
    ];
}
