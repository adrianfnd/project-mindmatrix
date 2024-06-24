<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str as Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// model
use App\Models\biodata as Biodata;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasUuids,HasRoles,HasApiTokens;

    protected $table = "users";
    protected $primaryKey = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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

    public function biodata(): HasOne
    {
        return $this->hasOne(Biodata::class,'user_id','id');
    }
}
