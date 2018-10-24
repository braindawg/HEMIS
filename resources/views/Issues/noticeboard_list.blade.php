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
                        $body_text =substr($body_text, 0, 600);                                              
                        ?>
                    <li class="todo-projects-item noticeboar_list">
                        <h3>{{$announcement->title}}</h3>
                        <p>تاریخ نشر:{{ $announcement->date()}}</p>
                        <p>{!!$body_text!!} <span><a href="{{URL::to('/announcements/'.$announcement->id)}}">...بیشتر بخواند</a></span> </p>
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

