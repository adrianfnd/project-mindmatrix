<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


// model 
use App\Models\test_description as Test;
use App\Models\log_jawaban_user as Log_Test;
use App\Models\biodata as Biodata;
use Illuminate\Database\Eloquent\Relations\HasOne;

class log_test_user extends Model
{
    use HasFactory;
    protected $table = "log_test_users";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_test',
        'id_biodata',
    ];

    public  function test() : BelongsTo
    {
        return $this->belongsTo(Test::class,'id','id_test');
    }

    public function biodata() : HasOne
    {
        return $this->hasOne(Biodata::class,'id','id_biodata');
    }

    public function log_test() : HasOne
    {
        return $this->hasOne(Log_Test::class,'id_log','id');
    }
}
