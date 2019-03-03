@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">                                            
                        <div class="actions pull-right">
                            @if(0)
                            <div class="btn-group">
                                <a class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" href="javascript:;" > {{ trans('general.old_semesters') }}: {{ \App\Models\Semester::find($semesterId)->title }}
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    @foreach($semesters as $semester)
                                    <li>
                                        <a href="{{ route('teacher.timetable.courses', ['semester' => $semester->id]) }}"> {{ $semester->title }} 
                                            @if(defaultSemesterId() == $semester->id)
                                            ({{ trans('general.current') }})
                                            @endif

                                            @if($semesterId == $semester->id)
                                            <i class="fa fa-check"></i>
                                            @endif
                                        </a>
                                    </li>
                                    @endforeach                                    
                                </ul>
                            </div
                            @endif
                        </div>               
                    </div>
                    <div class="panel-body">                        
                       <table class="table">                    
                            <tr>                                
                                <th style="width:80px; border: 0">{{ trans('general.none_schedule') }}</th>                                
                                <td style="border: 0">              
                                    <div class="row">
                                        @foreach($unscheduledCourses as $key => $course)
                                        @continue(! $course)                                      
                                        <div class="col-sm-3">
                                            <div class="panel panel-info">
                                                <div class="panel-heading"> 
                                                    <?= $course->subject->title ?> 
                                                </div>
                                                <div class="panel-body">
                                                    <p><span class="font-blue">{{ trans('general.code') }}:</span> <span class="ltr"> <?= $course->code ?></span></p>
                                                    <p><span class="font-blue">{{ trans('general.department') }}:</span> <?= $course->department ? $course->department->name : '' ?></p>
                                                    <p><span class="font-blue">{{ trans('general.group') }}:</span> <?= $course->group ? $course->group->name : '' ?></p>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>                                                                   
                            </tr>
                            
                        @foreach(weekDays() as $key => $day)
                            <tr>                                
                                <th style="width:80px">{{ $day->day }}</th>                                
                                <td>              
                                    <div class="row">
                                        @foreach($courseTimes as $time)    
                                        @continue($time->day_id != $day->id)                               
                                        <div class="col-sm-3">
                                            <div class="panel panel-info">
                                                <div class="panel-heading"> 
                                                    <?= $time->course->subject->title ?> 
                                                </div>
                                                <div class="panel-body">
                                                    <p><span class="font-blue">{{ trans('general.code') }}:</span> <span class="ltr"> <?= $time->course->code ?></span></p>                                                    
                                                    <p><span class="font-blue">{{ trans('general.location') }}:</span> <?= $time->location ?></p>
                                                    <p><span class="font-blue">{{ trans('general.time') }}:</span> <?= $time->time ?></p>
                                                    <p><span class="font-blue">{{ trans('general.department') }}:</span> <?= $time->course->department ? $time->course->department->name : '' ?></p>
                                                    <p><span class="font-blue">{{ trans('general.group') }}:</span> <?= $time->course->group ? $time->course->group->name : '' ?></p>
                                                    <p><span class="font-blue"><a href="{{ route('teacher.timetable.course.list', $time->course) }}" class="btn btn-primary">{{ trans('general.course_list') }}</a></p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>                                                                   
                            </tr>
                        @endforeach
                       </table>
                    </div>
                </div>
            </div>
        </div>
@endsection