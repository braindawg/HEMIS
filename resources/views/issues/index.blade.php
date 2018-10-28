@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title pull-right">
                    <a href="{{ route('issues.create') }}" class="btn btn-info"><i class="icon-plus"></i> {{ trans('general.create_issue') }} </a>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <div class="scroller" style="height: 600px;" data-always-visible="1" data-rail-visible="0">
                        <ul class="feeds">
                            @foreach ($issues as $issue)
                                <li>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <a href="{{ route ('issues.show', $issue->id)}}">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="btn btn-outline btn-circle btn-xs blue">
                                                                <i class="fa fa-info-circle"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> {{$issue->title}}   </div>
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div style="color: black; margin-right: 40px">
                                                                       <p style="font-size: 11px;" >#{{$issue->id}} &nbsp; باز شده : &nbsp; {{$issue->date()}} &nbsp; <i class="fa fa-comments">{{$issue->comments->count()}}</i>  </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <tr>
                                                @if($issue->user_id == Auth::user()->id)
                                                    <td>
                                                        <a href="{{ route('issues.edit', $issue )}}" class="btn btn-outline btn-circle btn-xs blue">
                                                            <i class="fa fa-edit"></i></a>
                                                    </td>
                                                @endif
                                                @if($issue->user_id == Auth::user()->id || Auth::user()->hasRolle('super-admin'))
                                                    <td>
                                                        <form action="{{ route('issues.destroy' , $issue ) }}" method="post" style="display:inline">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <button type="submit" class="btn btn-outline btn-circle btn-xs blue" onClick="doConfirm()"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 4px; margin-bottom: 4px">
                                </li>
                            @endforeach
                        </ul>
                        <div class="pagination">
                            <?php echo $issues->links(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')

