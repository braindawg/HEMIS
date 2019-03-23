@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title" style="border: 0">

            <div class="tools"> </div>
        </div>
        <div class="portlet-body">

            <div class="form-horizontal">
            
            
            <div class="form-body" id="app">
            <table class="table">
                <tr>
                    <th style="width: 60px">شماره</th>
                    <th>{{ trans('general.code') }}</th>
                    <th>{{ trans('general.year') }}</th>
                    <th>{{ trans('general.half_year') }}</th>
                    
                    <th>{{ trans('general.semister') }}</th>
                    <th>{{ trans('general.subject') }}</th>
                    <th>{{ trans('general.teacger') }}</th>
                    <th>{{ trans('general.group') }}</th>
                    <th>{{ trans('general.department') }}</th>
                    <th>{{ trans('general.day') }}</th>
                    <th>{{ trans('general.time') }}</th>
                    <th>{{ trans('general.location') }}</th>
                </tr>                    
                    <tr>
                        <td>1</td>
                        <td>kOOOOOO</td>
                        <td>jAMAL</td>
                        <td>rAHMAN</td>
                        <td>ASFDASD</td>
                        <td>
                            <input type="text" class="form-control score-input" name="" min="0" max="10" value="">
                        </td>
                    </tr>
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
            @else
            </div>            
            @endif
        </div>
    </div>
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
