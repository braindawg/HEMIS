<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Number extends Model
{

    public $guarded = [];

    // protected static function boot()
    // {
    //     parent::boot();         

    //     static::creating(function ($model) {
    //         $model->team_id = currentTeamId();
    //     });
    // }

    static public function getNextDocumentNumber($student, $type)
    {
        $obj = self::getExistingNumber($student, $type);

        if (! $obj) {
            $obj = self::create([                
                'student_id' => $student->id,
                'numberable_type' => $type,
                'number' => self::getNumber($student, $type)
            ]);
        }
   
        return $obj ? $obj->number : '';
    }

    static public function getExistingNumber($student, $type)
    {
        return self::whereRaw('Date(created_at) = CURDATE()')
            ->where('numberable_type', $type)
            ->where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    static public function getNumber($student, $type)
    {    
        $formatArray[1] = substr($student->kankor_year, -2);       
        $formatArray[2] =  $student->department->id;
        
        $formatArray[3] = "%";
        $likeString = implode('', $formatArray);
        
        $result = self::select(\DB::raw(' MAX(CAST(SUBSTRING(number, LOCATE("%", "'.$likeString.'"), LENGTH(number) - '.(strlen($likeString) - 1).' ) AS unsigned)) as maxNumber'))
            ->where('number', 'like', $likeString)
            ->where('numberable_type', $type)            
            ->first();

        $maxNumber = $result ? $result->maxNumber : 0;            
            
        $formatArray[3] = str_pad($maxNumber + 1, 3, '0', STR_PAD_LEFT);

        return implode('', $formatArray);
    }

    static public function getSeqNumber(User $student, $type) 
    {
        $number = self::where('student_id', $student->id)
            ->where( 'numberable_type', $type)
            ->first();        
        
        if ($number) {            
            return str_pad($number->number, 3, '0', STR_PAD_LEFT);
        }

        $max = self::where('numberable_type', $type)->select(\DB::raw('MAX(CAST(number as unsigned)) as aggregate'))->first();        
        $max = $max ? $max->aggregate : 0;

        $number = self::create([
            'student_id' => $student->id,
            'numberable_type' => $type,
            'number' => $max + 1
        ]);

        return str_pad($number->number, 3, '0', STR_PAD_LEFT);
    }
}