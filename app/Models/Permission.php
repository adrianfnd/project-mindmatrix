<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'uuid';
    protected $fillable = [

        
    ];
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
}
