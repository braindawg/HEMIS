@extends('layouts.app')

@section('content') 

                    <div class="todo-container">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="todo-projects-container">
                                    <?php 
                                    foreach($noticeboards as $noticeboard)
                                    {      
                                        $body_text= $noticeboard->body;
                                        $body_text =substr($body_text, 0, 600);                                              
                                        ?>
                                    <li class="todo-projects-item noticeboar_list">
                                        <h3>{{$noticeboard->title}}</h3>
                                        <p>{!!$body_text!!} <span><a href="{{URL::to('/noticeboards/'.$noticeboard->id)}}">...بیشتر بخواند</a></span> </p>
                                    </li>
                                    <hr>
                                    <?php }?>
                                </ul>   
                                <div class="pagination">
                                    <?php echo $noticeboards->links(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection('content')

