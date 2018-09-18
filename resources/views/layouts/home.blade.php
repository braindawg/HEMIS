@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="portlet">

            <div class="row">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
                    <script type="text/javascript">
                        var labels = {!!json_encode($provinces -> pluck('province')) !!};
                        
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
                </div>
                <h3 class="text-center">تعداد کامیاب کانکور بر اساس ولایات (1397)</h3>
                <div class="col-md-12 charts-canvas">
                        <canvas  id="provinces-pie-chart" width="250" height="270"></canvas> 
                </div>
                <script type="text/javascript">
                    new Chart(document.getElementById("provinces-pie-chart"), {
                        type: 'pie',
                        data: {
                            labels: [@foreach($provinces as $province)
                                "{{ $province->province }}" {{ $loop -> last ? '' : ',' }}
                                @endforeach
                            ],
                            datasets: [{
                                label: "Population (millions)",
                                backgroundColor: [@foreach($provinces as $province)
                                    "#{{ str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT) }}" {{$loop -> last ? '' : ','}}
                                    @endforeach
                                ],
                                data: [@foreach($provinces as $province)
                                    "{{ $province->count }}" {{$loop -> last ? '' : ','}}
                                    @endforeach
                                ]
                            }]
                        },
                        options: {
                            title: {
                                display: false,
                            },
                            legend: {
                                position: 'bottom',
                                reverse: true,
                                fontFamily: 'nazanin'
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="portlet">
            <div class="row">   
                <h3 class="text-center">تعداد کامیاب کانکور بر اساس پوهنتون ها (1397)</h3>
                <div class="col-md-12 charts-canvas">
                    <canvas id="universities-pie-chart" width="250" height="270"></canvas>
                </div>
                
                <script type="text/javascript">
                    new Chart(document.getElementById("universities-pie-chart"), {
                        type: 'pie',
                        data: {
                            labels: [@foreach($universities as $university)
                                "{{ $university->name }}" {{$loop -> last ? '' : ','}}
                                @endforeach
                            ],
                            datasets: [{
                                label: "Population (millions)",
                                backgroundColor: [@foreach($universities as $university)
                                    "#{{ str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT) }}" {{$loop -> last ? '' : ','}}
                                    @endforeach
                                ],
                                data: [@foreach($universities as $university)
                                    "{{ $university->count }}" {{$loop -> last ? '' : ','}}
                                    @endforeach
                                ]
                            }]
                        },
                        options: {
                            title: {
                                display: false,
                            },
                            legend: {
                                position: 'bottom',
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
<div class="portlet">
    <div class="row">
        <h1 class="text-center">تعداد محصلین براساس وضعیت در هر پوهنتون (1397)</h1>
        <div class="col-md-12 charts-canvas">
                <canvas id="universities-bar-chart" width="240" height="170"></canvas>
        </div>

        <script type="text/javascript">
            new Chart(document.getElementById("universities-bar-chart"), {
                type: 'bar',
                data: {
                    labels: [@foreach($universityStatus as $university)
                        "{{ $university->name }}" {{$loop -> last ? '' : ','}}
                        @endforeach
                    ],
                    datasets: [
                        @foreach($statuses as $status) {
                            label: "{{ $status->title }}",
                            backgroundColor: window.chartColors.c{{$loop -> iteration}},
                            stack: 1,
                            data: [@foreach($universityStatus as $university) {{$university -> studentsByStatus -> where('status_id', $status -> id) -> first() -> students_count ?? 0}}{{$loop -> last ? '' : ','}}@endforeach],
                        } {{$loop -> last ? '' : ','}}
                        @endforeach]
                },
                options: {
                    title: {
                        display: false,
                    },
                    legend: {
                        
                        position: 'bottom',
                        reverse: true,
                        fontFamily: 'nazanin'
                    },
                    sclaes: {
                        scales: {
                            yAxes: [{
                                stacked: true
                            }]
                        }
                    }
                }
            });
        </script>
    </div>
</div>
@endsection