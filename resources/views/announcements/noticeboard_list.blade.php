@extends('layouts.app')

@section('content') 
    <div class="todo-container">
        <div class="row">
            <div class="col-md-12">
                <ul class="todo-projects-container">                 
                @foreach($announcements as $announcement)      
                    <li class="todo-projects-item noticeboar_list">
                        <h3>
                            <a href="{{ $announcement->href() }}">
                            {{$announcement->title}} 
                            @if(! $announcement->visited())
                            &nbsp;&nbsp; <span class="badge badge-danger"> جدید </span>
                            @endif
                            </a>
                        </h3>                    
                        <p>تاریخ نشر:{{ $announcement->date()}}</p>
                        <p>
                            {!! $announcement->excerpt(400) !!}
                        </p>
                        <a href="{{ $announcement->href() }}" style = "font-size : 13px">
                            مشاهده اعلان 
                        </a>
                        
                    </li>
                    <hr>
                @endforeach
                </ul>   
                <div class="pagination">
                    <?php echo $announcements->links(); ?>
                </div>
            </div>
        </div>
    </div>
@endsection('content')

