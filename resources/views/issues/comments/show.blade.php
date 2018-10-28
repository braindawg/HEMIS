@extends('layouts.app')

@section('content')
    <div class="blog-page blog-content-2">
        <div class="row">
            <div class="col-lg-9">
                <div class="blog-single-content bordered blog-container">
                    <div class="blog-single-head">
                        <h1 class="blog-single-head-title">{{$issue->title}}</h1>
                    </div>
                    <div class="blog-single-head-date">
                        <i class="icon-user font-blue">ارسال شده: &nbsp;{{$issue->user->name}}</i>
                        <i class="icon-calendar font-blue"> تاریخ ارسال: &nbsp;{{$issue->date()}}</i>
                        <i class="fa fa-comments font-blue"> کمنت ها: &nbsp;{{$issue->comments->count()}}</i>
                    </div>
                    <div class="blog-single-desc">
                        {!!$issue->body!!}
                    </div>
                    <hr>
                    @foreach($issue->attachments as $attachment)
                        <div class="blog-single-img" style="padding-top: 0px; border: 1px solid lightgray">
                            <img src="{{url('/getAttachment/'.$attachment->file)}}" style="height: 400px">
                        </div>
                    @endforeach
                    <div class="blog-comments" style="display: inline">
                        <div class="c-comment-list">
                            @foreach($issue->comments as $comment)
                                <div id="c{{$comment->id}}">
                                    <div class="media" id=" {{$comment->id}}">
                                      
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                {{--Comment Delete Section should only visible to Admin user--}}
                                                <div>
                                                    <h4 style="padding-right: 20px;"><i id="{{$comment->id}}" onclick="deletecomment(this.id)" class="fa fa-times btn-xs pull-right" title="Delete Comment" style="cursor: pointer"></i>
                                                    </h4>
                                                </div>
                                                {{--End delete Section--}}
                                                <span class="font-blue" style="font-size: 16px;">{{$comment->user->name}}</span></h4>{!! $comment->comment !!}
                                            &nbsp;&nbsp;<span class="c-date" style="font-size: 11px; color: #0d638f">زمان نظر:{{$comment->date()}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{--append comments--}}
                            <div id="comments"></div>
                            <h1 class="center-align" style="width: inherit">
                                <img src="{{ asset('img/ajax-loading.gif')}}" id="commet_loading" style="height: 60px;width: 60px;display: none;">
                            </h1>
                            <h3 class="sbold blog-comments-title">{{trans('general.comment')}}</h3><br>
                            <div class="form-group">
                                <textarea rows="8" name="message" id="summernote" placeholder="Write comment here ..." class="form-control c-square"></textarea>
                            </div>
                            <div class="form-group">
                                <button onclick="message({{$issue->id}})" class="btn blue uppercase btn-md sbold btn-block">{{trans('general.submit')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="{{ asset('js/comment.js') }}"></script>


