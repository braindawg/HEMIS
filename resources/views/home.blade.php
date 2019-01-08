@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="portlet text-center" style ="border-bottom: 2px solid #e05038;">
            @if( auth()->user()->allUniversities())
            <h3>تعداد پوهنتون ها</h3>
            @else
            <h3> پوهنتون </h3>
            @endif
            <hr>
            @if( auth()->user()->allUniversities())
                <h1 class = "counter">{{ count($allUniversities) }}</h1>
            @else 
                <h1>{{ $universityName }}</h1>
            @endif

        </div>
    </div>
    <div class="col-md-3 col-sm-6">
         <div class="portlet text-center" style ="border-bottom: 2px solid #28A744;">
            <h3>تعداد دیپارتمنت ها</h3>
            <hr>
            <h1 class = "counter">{{ count($allDepartments) }}</h1>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
         <div class="portlet text-center" style ="border-bottom: 2px solid #62bcfa;">
            <h3>تعداد محصلین کامیاب</h3>
            <hr>
            <h1 class = "counter">{{ $allStudents }}</h1>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
         <div class="portlet text-center" style ="border-bottom: 2px solid #f2b632;">
            <h3>تعداد  محصلین شامل پوهنتون</h3>
            <hr>
            @if(sizeof($studentsByStatusCount) > 1)
                <h1 class = "counter">{{ $studentsByStatusCount[1]->students_count }}</h1>  
            @else
                <h1 class = "counter">0</h1>  
            @endif
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="col-md-1 col-sm-2">
                    <h3 style="text-align: left">سال:</h3>
                </div>
                <div class="col-md-3 col-sm-4">
                    <select onchange = "kankorYear(this.value)" name="kankor" id="kankor" class="form-control" style="width: 80% !important; margin-top:16px;"onChange="getUniSpecData(this.value, 'province-specific')">
                        <option>{{$current_kankor_year}}</option>                       
                        @foreach($kankorYears as $year)
                        <option {{ $current_kankor_year == $year->kankor_year ? 'selected' : '' }}>{{$year->kankor_year}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div id="universities-bar-chart" style="min-width: 310px; min-height: 400px; "></div> 
            <script  type="text/javascript">
                Highcharts.chart('universities-bar-chart', {
                        chart: {
                            type: 'column',
                            plotBackgroundColor: '#E9EEFF'
                        },
                        colors: ['#f2b632', '#fd7474', '#28A744', '#17a2b8'],
                        credits:{
                                    enabled: false
                        },
                        title: {
                            text: 'تعداد محصلین براساس وضعیت در هر پوهنتون - {{$current_kankor_year}}'
                        },
                        xAxis: {
                            categories: [@foreach($studentsByStatus as $category)
                            @if($category->name == 'انستیتوت تکنالوژی معلوماتی ومخابراتی وزارت مخابرات')
                                                'انستیتوت مخابرات'
                                            @else
                                                '{{ $category->name }}'
                                            @endif
                                            {{$loop -> last ? '' : ','}}
                            @endforeach]
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: "{{ trans('general.chart_yaxis_title_full') }}"
                            },
                            stackLabels: {
                                enabled: true,
                                style: {
                                    fontWeight: 'bold',
                                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                }
                            }
                        },
                        legend: {
                            align: 'right',
                            x: -30,
                            verticalAlign: 'top',
                            y: 25,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                        },
                        tooltip: {
                            headerFormat: '<span><b>{series.name}</b></span><table>',
                            pointFormat: '<tr><td>{point.y}</td></tr><tr><td>Total: {point.stackTotal}</td></tr>',
                            footerFormat: '</table>',
                            useHTML: true

                        },
                        plotOptions: {
                            column: {
                                stacking: 'normal',
                                dataLabels: {
                                    enabled: false,
                                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                                }

                            }
                        },
                        series: [ @foreach($statuses as $status)
                            {
                            name: '{{ $status->title }}',
                            data: [@foreach($studentsByStatus as $studentsData) {{$studentsData -> studentsByStatus -> where('status_id', $status -> id) -> first() -> students_count ?? 0}} {{$loop -> last ? '' : ','}} @endforeach]
                        }{{$loop -> last ? '' : ','}}
                        @endforeach]
                });
            </script>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="portlet">

            <div>
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                       
            
                <div id="province-container" style="min-width: 310px; min-height: 500px; "></div> 
                <script type="text/javascript">
                    
                        Highcharts.chart('province-container', {
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'
                            },
                            title: {
                                text: 'تعداد کامیاب کانکور بر اساس ولایات - {{$current_kankor_year}}'
                            },
                            credits:{
                                enabled: false
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: false
                                    },
                                    showInLegend: true
                                }
                            },
                            series: [{
                                name: 'Students',
                                colorByPoint: true,
                                data: [ @foreach($provinces as $province)
                                    
                                    {
                                    name: '{{ $province->province }}',
                                    y: {{ $province->count }},
                                   
                                } {{ $loop->last ? '' : ',' }}
                                @endforeach ]
                            }]
                        });
                </script>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="portlet">
                <div id="university-container" style="min-width: 310px; min-height: 500px; "></div> 

                <script type="text/javascript">
                
                        Highcharts.chart('university-container', {
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'
                            },
                            title: {
                                text: 'تعداد کامیاب کانکور بر اساس پوهنتون ها - {{$current_kankor_year}}'
                            },
                            credits:{
                                enabled: false
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: false
                                    },
                                    showInLegend: true
                                }
                            },
                            series: [{
                                name: 'Students',
                                colorByPoint: true,
                                data: [ @foreach($universities as $university)
                                    
                                    {
                                        @if($university->name == ' تکنالوژی معلوماتی ومخابراتی وزارت مخابرات')
                                            name: 'انستیتوت مخابرات',
                                        @else
                                            name: '{{ $university->name }}',
                                        @endif
                                        y: {{ $university->count }},
                                   
                                } {{ $loop->last ? '' : ',' }}
                                @endforeach ]
                            }]
                        });
                </script>
            </div>
    </div>
</div>

 <!-- this portlet is used to show chart for students of a specific city in all other cities -->
@if( auth()->user()->allUniversities())
    <div class="row">
        <div class="col-md-12">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="col-md-1 col-sm-12">
                        <h3 style="text-align: left">ولایت:</h3>   
                    </div>
                    <div class="col-md-3 col-sm-12" >
                        <select name="cities" id="" class="form-control" style = "width: 80% !important; margin-top:16px;" onChange="getCitySpecData(this.value, 'university-specific')">
                            @foreach($allProvinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="university-specific" style="min-width: 310px; min-height: 400px; "></div>
                    <script  type="text/javascript">
                        Highcharts.chart('university-specific', {
                            chart: {
                                type: 'column',
                                plotBackgroundColor: '#FCFFC5'
                            },
                            colors: ['#17a2b8' ],
                            credits:{
                                        enabled: false
                            },
                            title: {
                                text: 'تعداد محصلین ولایت {{$city}} بر اساس پوهنتون ها'
                            },
                            xAxis: {
                                categories: [@foreach($uniSpecStudents as $uniSpec)
                                    @if($uniSpec-> name == 'انستیتوت تکنالوژی معلوماتی ومخابراتی وزارت مخابرات')
                                        'انستیتوت مخابرات'
                                    @else
                                    '{{ $uniSpec->name }}'
                                    @endif
                                        {{$loop -> last ? '' : ','}}
                                @endforeach]
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: "{{ trans('general.barchart_yaxis_title') }}"
                                },
                                stackLabels: {
                                    enabled: true,
                                    style: {
                                        fontWeight: 'bold',
                                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                    }
                                }
                            },
                            legend: {
                                align: 'right',
                                x: -30,
                                verticalAlign: 'top',
                                y: 25,
                                floating: true,
                                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                                borderColor: '#CCC',
                                borderWidth: 1,
                                shadow: false
                            },
                            tooltip: {
                                headerFormat: '<span><b>{series.name}</b></span><table>',
                                pointFormat: '<tr><td>{point.y}</td></tr>',
                                footerFormat: '</table>',
                                useHTML: true

                            },
                            plotOptions: {
                                column: {
                                    stacking: 'normal',
                                    dataLabels: {
                                        enabled: false,
                                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || '17a2b8'
                                    }

                                }
                            },
                            series: [{
                                name: 'تعداد محصلین',
                                data: [ @foreach($uniSpecStudents as $uniSpec) {{ $uniSpec->std_count }} {{ $loop->last ? '' : ',' }} @endforeach]
                            }
                        ]
                    });
            </script>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="col-md-1 col-sm-2">
                    <h3 style="text-align: left">پوهنتون:</h3>
                </div>
                <div class="col-md-3 col-sm-4">
                    <select name="universities" id="" class="form-control" style="width: 80% !important; margin-top:16px;"onChange="getUniSpecData(this.value, 'province-specific')">
                        @foreach($allUniversities as $university)
                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="province-specific" style="min-width: 310px; min-height: 400px; "></div>
            <script type="text/javascript">
                Highcharts.chart('province-specific', {
                    chart: {
                        type: 'column',
                        plotBackgroundColor: '#e1e8f0'
                    },
                    colors: ['#e62739' ],
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: ' تعداد محصلین پوهنتون  {{$uniName}} بر اساس ولایت'
                    },
                    xAxis: {
                        categories: [@foreach($proSpecStudents as $proSpec)
                        '{{ $proSpec->name }}' {{ $loop -> last ? '' : ','}}
                            @endforeach
                        ]
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: "{{ trans('general.barchart_yaxis_title') }}"
                        },
                        stackLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold',
                                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                            }
                        }
                    },
                    legend: {
                        align: 'right',
                        x: -30,
                        verticalAlign: 'top',
                        y: 25,
                        floating: true,
                        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                        borderColor: '#CCC',
                        borderWidth: 1,
                        shadow: false
                    },
                    tooltip: {
                        headerFormat: '<span><b>{series.name}</b></span><table>',
                        pointFormat: '<tr><td>{point.y}</td></tr>',
                        footerFormat: '</table>',
                        useHTML: true

                    },
                    plotOptions: {
                        column: {
                            stacking: 'normal',
                            dataLabels: {
                                enabled: false,
                                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || '6FC827'
                            }

                        }
                    },
                    series: [{
                        name: "{{ trans('general.barchart_series_name') }} ",
                        data: [@foreach($proSpecStudents as $proSpec) {{ $proSpec -> std_count}} {{ $loop -> last ? '' : ',' }}
                            @endforeach]
                    }]
                });
            </script>
        </div>
    </div>
</div>

@endif

<!-- Ajax methdd to update data on province change for the province specific column chart -->
<script src="{{ asset('js/ajaxCharts.js') }}" type="text/javascript"></script>

@endsection



@push('scripts')

    <script>
        function kankorYear(value){
            
            var year = value;

            window.location.href = window.location.origin + "/home/" + year;

        }
    </script>
    
@endpush