@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="portlet-title">
            @can ('create-student')
            <a href="{{ route('students.create') }}" class="btn btn-primary"><i class="icon-plus"></i> {{ trans('general.create_student') }} </a>
            @endcan
            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
        
        {!! $dataTable->table() !!}
        </div>
    </div>
@endsection

@push('styles')
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