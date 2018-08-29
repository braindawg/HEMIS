<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();
    }

    public function setPasswordAttribute($value)
    {           
        if ($value != '') {
            $this->attributes['password'] = Hash::make($value);
        }        
    }

    public function university()
    {
        return $this->belongsTo(\App\Models\University::class);
    }

    public function departments()
    {
        return $this->belongsToMany(\App\Models\Department::class)->withTimestamps()->withoutGlobalScopes();
    }
}
