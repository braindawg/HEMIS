@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">            

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js" ></script>
                <script type="text/javascript">
                    var labels = {!! json_encode($provinces->pluck('province')) !!};
                    window.chartColors = {
                        c1: 'rgb(255, 99, 132)',
                        c2: 'rgb(255, 159, 64)',
                        c3: 'rgb(255, 205, 86)',
                        c4: 'rgb(75, 192, 192)',
                        c5: 'rgb(54, 162, 235)',
                        c6: 'rgb(153, 102, 255)',
                        c7: 'rgb(201, 203, 207)',
                        c8: 'rgb(255, 99, 132)',
                        c9: 'rgb(255, 159, 64)',
                        c10: 'rgb(255, 205, 86)',
                        c11: 'rgb(75, 192, 192)',
                        c12: 'rgb(54, 162, 235)',
                        c13: 'rgb(153, 102, 255)',
                        c14: 'rgb(201, 203, 207)'
                    };
                </script>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <canvas id="provinces-pie-chart" width="400" height="400" ></canvas>
                        <script type="text/javascript">
                            new Chart(document.getElementById("provinces-pie-chart"), {
                                type: 'pie',
                                data: {
                                labels: [@foreach($provinces as $province) "{{ $province->province }}" {{ $loop->last ? '' : ',' }} @endforeach],
                                datasets: [{
                                    label: "Population (millions)",
                                    backgroundColor: [@foreach($provinces as $province) "#{{ str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT) }}" {{ $loop->last ? '' : ',' }} @endforeach],
                                    data: [@foreach($provinces as $province) "{{ $province->count }}" {{ $loop->last ? '' : ',' }} @endforeach]
                                }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: 'تعداد کامیاب کانکور بر اساس ولایات (1397)'
                                    },
                                    legend: {
                                        position: 'left',
                                        reverse: true,
                                        fontFamily: 'nazanin'
                                    }
                                }
                            });
                        </script>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <canvas id="universities-pie-chart" width="400" height="400" ></canvas>
                            <script type="text/javascript">
                                new Chart(document.getElementById("universities-pie-chart"), {
                                    type: 'pie',
                                    data: {
                                    labels: [@foreach($universities as $university) "{{ $university->name }}" {{ $loop->last ? '' : ',' }} @endforeach],
                                    datasets: [{
                                        label: "Population (millions)",
                                        backgroundColor: [@foreach($universities as $university) "#{{ str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT) }}" {{ $loop->last ? '' : ',' }} @endforeach],
                                        data: [@foreach($universities as $university) "{{ $university->count }}" {{ $loop->last ? '' : ',' }} @endforeach]
                                    }]
                                    },
                                    options: {
                                        title: {
                                            display: true,
                                            text: 'تعداد کامیاب کانکور بر پوهنتون ها (1397)'
                                        },
                                        legend: {
                                            position: 'left',
                                            reverse: true,
                                            fontFamily: 'nazanin'
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
            
            </div>
        </div>
    </div>
</div>
@endsection
