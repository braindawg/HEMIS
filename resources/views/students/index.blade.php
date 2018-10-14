@extends('layouts.app')

@section('content')

    <div class="tabbable-custom ">
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
        <div class="tab-content" style="padding: 0; border: 0">
            <div class="portlet light bordered card" style="border-top: 0 !important">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="portlet-title">
                    @can ('create-student')
                    <a href="{{ route('students.create') }}" class="btn btn-info"><i class="icon-plus"></i> {{ trans('general.create_student') }} </a>
                    @endcan
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                
                {!! $dataTable->table([], true) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .datatable-footer-input {
            padding: 2px 5px;
        }
        .datatable-footer-select, .datatable-footer-input {
            width: 100px;
        }
        table.dataTable tfoot td, table.dataTable tfoot th {
            padding: 5px !important;
        }
    </style>
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> -->
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
    <!-- <style>
    table td, table th {
        font-size: 12px !important;
    }
    </style> -->
@endpush

@push('scripts')
    <script src="{{ asset('js/datatables.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $.fn.dataTable.ext.errMode = 'none';
    </script>
@endpush