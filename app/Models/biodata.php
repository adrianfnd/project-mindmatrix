<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Str as Str;

// Model
use App\models\User as User;

class biodata extends Model
{
    use HasFactory, HasUlids;

    protected $table = "biodatas";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_lengkap',
        'user_id',
        'tanggal_lahir',
    ];

    public $timestamps = true;

    protected static function boot(){
        parent::boot();
        static::creating(function ($model){
            if(empty($model->{$model->getKeyName()})){
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

    }
     public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }


    public function user() : HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}
