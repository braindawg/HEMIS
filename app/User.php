<?php

namespace App;

use App\Traits\UseByUniversity;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles, Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $developers = [
        'rajabi@rubik.af', 
        'badruddin2014@gmail.com',
        'o_abdulbasit@yahoo.com',
        'eng.sazeem@gmail.com'
    ];

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

    public function allUniversities()
    {
        return $this->university_id == -1;
    }

    public function noticeboardView()
    {
        return $this->hasMany(\App\Models\NoticeboardView::class);
    }

    public function isDeveloper()
    {
        return in_array($this->email, $this->developers);
    }

    public function canImpersonate()
    {
        return $this->isDeveloper();
    }

    public function canBeImpersonated()
    {
        return ! $this->isDeveloper();
    }
}
