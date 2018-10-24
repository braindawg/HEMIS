@extends('layouts.app')

@section('content') 
    <div class="todo-container">
        <div class="row">
            <div class="col-md-12">
                <ul class="todo-projects-container">
                    <?php 
                    foreach($announcements as $announcement)
                    {      
                        $body_text= $announcement->body;
                        $body_text =str_limit($body_text, 400,'...');
                        ?>
                    <li class="todo-projects-item noticeboar_list">
                    @if($announcement->userView($announcement->id,\Auth::user()->id)==1 )
                        <h3>{{$announcement->title}}</h3>
                    @else
                        <h3>{{$announcement->title}} &nbsp;&nbsp; <span class="badge badge-danger"> جدید </span></h3>
                    @endif
                        <p>تاریخ نشر:{{ $announcement->date()}}</p>
                        <p>{!!$body_text!!} <span><a href="{{URL::to('/announcements/'.$announcement->id)}}"><span style = "font-size : 13px">...بیشتر بخواند</span></a></span> </p>
                    </li>
                    <hr>
                    <?php }?>
                </ul>   
                <div class="pagination">
                    <?php echo $announcements->links(); ?>
                </div>
            </div>
        </div>
    </div>
@endsection('content')

