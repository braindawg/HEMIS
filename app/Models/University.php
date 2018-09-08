<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class University extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {                                   
        });
        
        static::updating(function ($model) {                                   
        });
    }
    public function departments()
    {
        return $this->hasMany(\App\Models\Department::class);
    }
    public function students()
    {
        return $this->hasMany(\App\Models\Student::class);
    }
    public function studentsByStatus()
    {
        return $this->students()->select('university_id', 'status_id', \DB::raw('COUNT(students.id) as students_count'))
            ->groupBy('university_id', 'status_id');
    }
}