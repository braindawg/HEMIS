@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title" style="border: 0">

            <a href="{{ route('courses.index') }}" class="btn btn-default"><i class="icon-arrow-right"></i> {{ trans('general.back') }}</a>
            <a href="{{ route('course.attendance.print', $course ) }}" class="btn btn-default" target="new"><i class="fa fa-print"></i> {{ trans('general.print_attendance') }}</a>
            <a href="{{ route('course.scoresSheet.print', $course ) }}" class="btn btn-default" target="new"><i class="fa fa-print"></i> {{ trans('general.print_scores_sheet') }}</a>
            <a href="{{ route('course.scoresSheet.print', [$course, 1]) }}" class="btn btn-default" target="new"><i class="fa fa-print"></i> {{ trans('general.print_filled_scores_sheet') }}</a>

            <div class="tools"> </div>
        </div>
        <div class="portlet-body">

            @if(auth()->user()->can('edit-course'))
            {!! Form::open(['route' => ['scores.store', $course], 'method' => 'post', 'class' => 'form-horizontal']) !!} 
            @else
            <div class="form-horizontal">
            @endif
            
            {!! Form::hidden('course[course_id]', $course->id) !!}
            {!! Form::hidden('course[subject_id]', $course->subject_id) !!}
            {!! Form::hidden('course[semester]', $course->semester) !!}
            
            <div class="form-body" id="app">
            <table class="table">
                <tr>
                    <th style="width: 60px">شماره</th>
                    <th>{{ trans('general.kankor_id') }}</th>
                    <th>{{ trans('general.name') }}</th>
                    <th>{{ trans('general.father_name') }}</th>
                    <th>{{ trans('general.kankor_year') }}</th>
                    <th>{{ trans('general.homework') }}</th>
                    <th>{{ trans('general.classwork') }}</th>
                    <th>{{ trans('general.midterm') }}</th>
                    <th>{{ trans('general.final') }}</th>
                    <th>{{ trans('general.total') }}</th>
                    <th>{{ trans('general.chance_two') }}</th>
                    <th>{{ trans('general.chance_three') }}</th>
                    @can('edit-course')
                    <th>{{ trans('general.delete') }}</th>
                    @endcan
                </tr>
                @foreach($course->students as $student)
                @php                    
                    $score = $student->scores->first();
                @endphp                  
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->form_no }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->father_name }}</td>
                        <td>{{ $student->kankor_year }}</td>
                        <td>
                            <input type="number" class="form-control score-input" name="scores[{{ $student->id }}][homework]" min="0" max="10" value="{{ $score->homework ?? ''  }}">
                        </td>
                        <td>
                            <input type="number" class="form-control score-input" name="scores[{{ $student->id }}][classwork]" min="0" max="10" value="{{ $score->classwork ?? ''  }}">
                        </td>
                        <td>
                            <input type="number" class="form-control score-input" name="scores[{{ $student->id }}][midterm]" min="0" max="20" value="{{ $score->midterm ?? ''  }}">
                        </td>
                        <td>
                            <input type="number" class="form-control score-input" name="scores[{{ $student->id }}][final]" min="0" max="60" value="{{ $score->final ?? ''  }}">
                        </td>
                        <td style="vertical-align: middle">
                            {{ $score->total ?? ''  }}
                        </td>  
                        <td>
                            <input type="number" class="form-control score-input" name="scores[{{ $student->id }}][chance_two]" min="0" max="100" value="{{ $score->chance_two ?? ''  }}">
                        </td>
                        <td>
                            <input type="number" class="form-control score-input" name="scores[{{ $student->id }}][chance_three]" min="0" max="100" value="{{ $score->chance_three ?? ''  }}">
                        </td>
                        @can('edit-course')
                        <td>
                            <a href="javascript:;" 
                                onclick="event.preventDefault();
                                if(confirm('آیا مایل به پیشروی هستید؟')){
                                document.getElementById('student-id-field').value='{{ $student->id }}';
                                document.getElementById('delete-form').submit();}" 
                                class="dropdown-toggle" 
                                title="{{ trans('general.logout') }}">

                                <i class="fa fa-remove"></i>                           
                            </a>
                        </td>
                        @endcan
                    </tr>
                @endforeach
            </table>
            </div>
            @if(auth()->user()->can('edit-course'))
            <div class="form-actions fluid">
                <div class="row">
                    <div class="col-md-11">
                        <button type="submit" class="btn btn-primary">{{ trans('general.save_scores') }}</button>                        
                    </div>
                </div>
            </div>                 
            {!! Form::close()  !!}
            @else
            </div>            
            @endif
        </div>
    </div>

    @if(auth()->user()->can('edit-course'))
    <div class="row">
        <div class="col-md-6">
            <div class="portlet box">
                <div class="portlet-title" style="color: #000">
                   <h4>{{ trans('general.add_student_individually') }}</h4>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->            
                    {!! Form::open(['route' => ['attendance.student.add', $course], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                        <div class="form-body" id="app">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('student_id') ? ' has-error' : '' }}">
                                        {!! Form::label('student_id', trans('general.new_student'), ['class' => 'control-label col-sm-3']) !!}                                
                                        <div class="col-sm-7">
                                            {!! Form::select('student_id', [], null, ['class' => 'form-control select2-students', 'placeholder' => trans('general.select')]) !!}
                                            @if ($errors->has('student_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('student_id') }}</strong>
                                                </span>
                                            @endif                                                                                                   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn green">{{ trans('general.add') }}</button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
    @endif

    {!! Form::open(['route' => ['attendance.student.remove', $course], 'method' => 'delete', 'id' => 'delete-form', 'class' => 'form-horizontal', 'style' => 'display: none']) !!}
        <input type="hidden" id="student-id-field" name="student_id" >
        <button type="submit" class="btn btn-xs btn-danger" ></button>
    {!! Form::close() !!}
@endsection

@push('styles')
    <style>
        .score-input {
            text-align: left;
            direction: ltr;
            width: 80px;
        }
    </style>
@endpush


@push('scripts')
@if(! auth()->user()->can('edit-course'))
<script>
    $(function () {
        $('input["number"]').attr('disabled', 'disabled')
    })
</script>
@endif
@endpush
