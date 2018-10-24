@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-body">
                    <div class="scroller" style="height: 600px;" data-always-visible="1" data-rail-visible="0">
                        <ul class="feeds">
                            @foreach ($issues as $issue)
                                <li>
                                    <a href="{{URL::to('issue-show/'.$issue->id)}}">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-primary">
                                                        <i class="fa fa-question"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> {{$issue->title}}   </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')

