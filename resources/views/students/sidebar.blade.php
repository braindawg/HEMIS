@extends('layouts.app')

@section('content')
<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet bordered">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">                    
                    <a href="{{ auth()->user()->can('update-student-photo') ? route('students.photo', $student) : "#" }}">
                        <img src="{{ asset($student->photo_url) }}" class="img-responsive" alt=""> 
                    </a>                    
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> {{ $student->name }} </div>
                    <div class="profile-usertitle-job"> {{ $student->form_no }}</div>
                    <div class="profile-usertitle-job"> {{ $student->department ? $student->department->name : '' }}</div>
                    <div class="profile-usertitle-job"> {{ $student->university ? $student->university->name : '' }}</div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->               
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <br>
                <div class="profile-usermenu">

                    <ul class="nav">
                        <li class="{{ request()->is('students*edit') ? 'active' : '' }}">
                            <a href="{{ route('students.edit', $student)}}">
                                {{ trans('general.detail') }} 
                            </a>
                        </li>
                        <li class="{{ request()->is('*student-form') ? 'active' : '' }}">
                            <a href="{{ route('student.form', $student)}}">
                                {{ trans('general.student_form_generator') }} 
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    @yield('page')
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
    
@endsection('content')

@push('styles')
    <link href="{{ asset('css/profile-rtl.min.css') }}" rel="stylesheet">     
@endpush

@push('scripts')
<script>
    $(function () {
        $("input:not(.editable), select, .select2").each(function(){ 
            if ($(this).val() != '') {
                $(this).attr('readonly', 'readonly')
            }
        });
        $('.select2').change(function () {
            $('.select2-ajax').val(null).trigger('change');
        })
    })
</script>
@endpush