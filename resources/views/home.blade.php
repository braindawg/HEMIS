@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="portlet text-center" style ="border-bottom: 2px solid #e05038;">
            <h3>پوهنتون</h3>
            <hr>
            <h1>{{ count($allUniversities) }}</h1>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
         <div class="portlet text-center" style ="border-bottom: 2px solid #28A744;">
            <h3>پوهنځی</h3>
            <hr>
            <h1>{{ count($allDepartments) }}</h1>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
         <div class="portlet text-center" style ="border-bottom: 2px solid #62bcfa;">
            <h3>شاګرد کامیاب</h3>
            <hr>
            <h1>{{ $studentsByStatusCount[0]->students_count }}</h1>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
         <div class="portlet text-center" style ="border-bottom: 2px solid #f2b632;">
            <h3>شامل پوهنتون</h3>
            <hr>
            <h1>{{ $studentsByStatusCount[1]->students_count }}</h1>
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
                                text: 'تعداد کامیاب کانکور بر اساس ولایات - 1397'
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
                                text: 'تعداد کامیاب کانکور بر اساس پوهنتون ها - 1397'
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
                                        @if($university->name == 'انستیتوت تکنالوژی معلوماتی ومخابراتی وزارت مخابرات')
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



<div class="portlet">
        <!-- <h1 class="text-center">تعداد محصلین براساس وضعیت در هر پوهنتون (1397)</h1> -->
       
        <div id="universities-bar-chart" style="min-width: 310px; min-height: 400px; "></div> 

    <script  type="text/javascript">

                Highcharts.chart('universities-bar-chart', {
                    chart: {
                        type: 'column',
                        plotBackgroundColor: '#E9EEFF'
                    },
                    colors: ['#28A744', '#17a2b8'],
                    credits:{
                                enabled: false
                    },
                    title: {
                        text: 'تعداد محصلین براساس وضعیت در هر پوهنتون - 1397'
                    },
                    xAxis: {
                        categories: [@foreach($universities as $university)
                         @if($university->name == 'انستیتوت تکنالوژی معلوماتی ومخابراتی وزارت مخابرات')
                                            'انستیتوت مخابرات'
                                        @else
                                            '{{ $university->name }}'
                                        @endif
                                        {{$loop -> last ? '' : ','}}
                        @endforeach]
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'أمار شاګردها کامیاب و شامل پوهنتون'
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
                        data: [@foreach($universityStatus as $university) {{$university -> studentsByStatus -> where('status_id', $status -> id) -> first() -> students_count ?? 0}} {{$loop -> last ? '' : ','}} @endforeach]
                    }{{$loop -> last ? '' : ','}}
                    @endforeach]
            });
    
           
    </script>
    
</div>

 <!-- this portlet is used to show chart for students of a specific city in all other cities -->

<div class="portlet">

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 col-sm-12">
                    <h1>
                        <h3>لطف نموده ولایت را انتخاب نماید</h3>
                    </h1>
                </div>
                <div class="col-md-6 col-sm-12" >
                    <select name="cities" id="" class="form-control" style = "width: 80% !important; margin-top:16px;" onChange="getCitySpecData(this.value, 'university-specific')">
                        @foreach($allProvinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                    </h1>
                </div>
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
                        text: ' تعداد محصلین از ولایت {{$city}} در پوهنتونها'
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
                            text: 'أمار شاګردها کامیاب'
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
                    series: [
                        {
                        name: 'تعداد شاګردان',
                        data: [ @foreach($uniSpecStudents as $uniSpec) {{ $uniSpec->std_count }} {{ $loop->last ? '' : ',' }} @endforeach]
                        }
                   ]
            });
    
           
    </script>

   


</div>


<!-- this portlet is used to show chart for students of a specific city in all other cities -->

<div class="portlet">

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6 col-sm-12">
                <h1>
                    <h3>لطف نموده پوهنتون را انتخاب نماید</h3>
                </h1>
            </div>
            <div class="col-md-6 col-sm-12">
                <select name="universities" id="" class="form-control" style="width: 80% !important; margin-top:16px;"onChange="getUniSpecData(this.value, 'province-specific')">
                    @foreach($allUniversities as $university)
                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                    @endforeach
                </select>
                </h1>
            </div>
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
                text: ' تعداد محصلین نظر به ولایات در پوهنتون {{$uniName}} '
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
                    text: 'أمار شاګردها کامیاب'
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
                name: 'تعداد شاګردان',
                data: [@foreach($proSpecStudents as $proSpec) {{ $proSpec -> std_count}} {{ $loop -> last ? '' : ',' }}
                    @endforeach]
            }]
        });
    </script>


</div>

<!-- Ajax methdd to update data on province change for the province specific column chart -->
<script src="{{ asset('js/ajaxCharts.js') }}" type="text/javascript"></script>

@endsection