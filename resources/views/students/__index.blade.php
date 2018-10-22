@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{ trans('general.students_list') }}</h3>
    <div class="row">            
        <div class="col-md-12">
            @include('layouts.message')
                        
            <div class="tabbable-custom ">
                @permission('students.create')
                <a class="pull-right btn btn-primary btn-xs" href="{{route('students.create')}}" >
                    <i class="fa fa-plus"></i> {{ trans('general.add_student') }}
                </a>
                @endpermission
                <ul class="nav nav-tabs">
                    <li>
                        <a href="#all" class="student-status" data-status-id="all" data-toggle="tab">{{ trans('general.all_students') }}</a>
                    </li>
                    @foreach(\App\Models\StudentStatus::all() as $status)                 
                    <li>
                        <a href="#{{ $status->id }}" class="student-status" data-status-id="{{ $status->id }}" data-toggle="tab">{{ $status->title }}</a>
                    </li>
                    @endforeach                    
                </ul>                    
                <div class="tab-content">
                    {!! $dataTable->table([], true) !!}
                </div>
            </div>
            @permission('students.update')
            <div class="panel panel-default" id="update-panel">
                <div class="panel-heading clearfix">
                    {{ trans('general.students_batch_update') }}                                                                          
                </div>
                <div class="panel-body">
                    {!! Form::open(['method' => 'put' , 'id' => 'update-form']) !!}      
                        <div class="row">
                            <div class="form-group col-sm-3 {{ $errors->has('semester') ? ' has-error' : '' }}">                                                            
                                {!! Form::label('semester', trans('general.semester'), ['class' => '']) !!}                                
                                {!! Form::number('semester', null, ['class' => 'form-control ltr', 'min' => 1, 'max' => 16]) !!}     
                                @if ($errors->has('semester'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('semester') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                            <div class="form-group col-sm-3 {{ $errors->has('status') ? ' has-error' : '' }}">                                                           
                                {!! Form::label('status', trans('general.student_status'), ['class' => 'control-label']) !!}
                                {!! Form::select('status', $statuses, null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif                                 
                            </div>
                            <div class="form-group col-sm-3 {{ $errors->has('department') ? ' has-error' : '' }}">                                                                            
                                {!! Form::label('department', trans('general.department'), ['class' => 'control-label']) !!}
                                {!! Form::select('department', $departments, null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif                            
                            </div>
                            <div class="form-group col-sm-3{{ $errors->has('shift') ? ' has-error' : '' }}">                                                        
                                {!! Form::label('shift', trans('general.shift'), ['class' => 'control-label']) !!}                                
                                {!! Form::select('shift', $shifts, null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}
                                @if ($errors->has('shift'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shift') }}</strong>
                                    </span>
                                @endif                         
                            </div> 
                        </div>
                        <div class="row">                            
                            <div class="form-group col-sm-3 {{ $errors->has('category') ? ' has-error' : '' }}">                                                       
                                {!! Form::label('category', trans('general.student_category'), ['class' => 'control-label']) !!}                                
                                {!! Form::hidden('category', null, ['class' => 'form-control dropdown-student-categories', 'placeholder' => trans('general.select')]) !!}
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif                            
                            </div> 
                            <div class="form-group col-sm-3">                                                            
                                {!! Form::label('user_account', trans('general.user_account'), ['class' => 'control-label']) !!}                                
                                {!! Form::select('user_account', ['1' => trans('general.active'), '0' => trans('general.inactive')], null, ['class' => 'form-control select2', 'placeholder' => trans('general.select')]) !!}                                                                    
                            </div>                                                                                                                                                                                       
                        </div>
                        <hr>                                                                                                                                                                                                                                                                                                                                                                                                                                
                        <div class="form-group pull-left">                                 
                            <a id="submit" href="javascript:;" class="btn btn-primary">{{ trans('general.update') }}</a>                                
                        </div>                        
                    {!! Form::close() !!}
                    {!! Form::open(['route' => 'students.cards.kankor', 'method' => 'post' , 'id' => 'print-kankor-cards-form', 'target' => '_new']) !!}                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                        <div class="form-group pull-left">                                 
                            <a id="print-kankor-cards" href="javascript:;" class="btn btn-success"><i class="fa fa-print"></i> {{ trans('general.print_student_kankor_card') }}</a>                                
                        </div>                        
                    {!! Form::close() !!}
                </div>
            </div> 
            @endpermission                          
        </div>
    </div>    
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        $(function () {
            $('#submit').click(function() {
                var students = $('input:checkbox:checked').map(function(){
                        return this.value;
                }).get()

                if ($('input:checkbox:checked').length == 0)
                    return;
                // get the form data
                // there are many ways to get this data using jQuery (you can use the class or id also)
                var formData = {
                    '_method':          'POST',
                    '_token':           '{{ csrf_token() }}',
                    'students':          students,
                    'semester':          $('input[name=semester]').val(),
                    'status':            $('select[name=status]').val(),
                    'department':        $('select[name=department]').val(),
                    'registration_type': $('select[name=registration_type]').val(),
                    'shift':             $('select[name=shift]').val(),
                    'category':          $('input[name=category]').val(),
                    'user_account':      $('select[name=user_account]').val()
                };
                                
                // process the form
                $.ajax({
                    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url         : '{{ route("students.batchUpdate") }}', // the url where we want to POST
                    data        : formData, // our data object
                    dataType    : 'json', // what type of data do we expect back from the server
                    encode      : true
                })
                // using the done promise callback
                .done(function(data) {
                    // log data to the console so we can see
                    if (data.success) {
                        swal({
                           title: '{{ trans("general.it_is_done") }}',
                           text: '{{ trans("general.students_have_been_updated") }}',
                           type: 'success'
                        });
                        window.LaravelDataTables["dataTableBuilder"].ajax.reload( null, false );                                            
                    }
                    // here we will handle errors and validation messages
                }).fail(function(data) {                
                    swal({
                        title: '{{ trans("general.oops") }}',                      
                        text: '{{ trans("general.please_try_again") }}',                      
                        type: 'error'
                    });
                });
                // stop the form from submitting the normal way and refreshing the page                
            });

            $('#print-kankor-cards').click(function() {
                form = $('#print-kankor-cards-form');

                if ($('input:checkbox:checked').length == 0)
                    return;

                $('.hidden-students').remove();

                $('input:checkbox:checked').map(function(){
                    $('<input type="hidden" class="hidden-students" name="students[]" />').attr({                        
                        value: this.value
                    }).appendTo(form);
                })
                
                form.submit();                                               
            });
        });
    </script>
@endpush
