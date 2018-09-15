@extends('layouts.app')

@section('content')
    <div class="portlet light bordered card">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="portlet-title">
            @can ('create-student')
            <a href="{{ route('dropouts.create') }}" class="btn btn-info"><i class="icon-plus"></i> {{ trans('general.create_dropouts') }} </a>
            @endcan
            <div class="tools"> </div>
        </div>
        <div class="portlet-body">
        
        {!! $dataTable->table() !!}
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/datatables.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $.fn.dataTable.ext.errMode = 'none';
    </script>
@endpush