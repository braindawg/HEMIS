<?php

namespace App\Nova\Metrics;

use App\Models\Student;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class StudentsPerUniversity extends Partition
{

    public function name()
    {
        return __('محصل بر اساس پوهنتون');
    }
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->count($request, Student::join('universities', 'university_id', '=', 'universities.id'), 'universities.name');
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'students-per-university';
    }
}
