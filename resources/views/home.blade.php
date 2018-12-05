@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="portlet text-center" style ="border-bottom: 2px solid #e05038;">
            <h3>تعداد پوهنتون ها</h3>
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
            <h3>تعداد پوهنځی ها</h3>
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

<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="col-md-1 col-sm-2">
                    <h3 style="text-align: left">فعالیت ها </h3>
                </div>
            
            </div>
            <div id="mycontainer" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          
            <script type="text/javascript">
                
Highcharts.chart('mycontainer', {
    chart: {
        type: 'spline'
     },
    title: {
        text: 'گراف فعالیت های ۳۰ روز گذشته'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
         @foreach($dates as $d)
         {{ $d.','}}         
          @endforeach 
        ]
         
    },
    yAxis: {
        title: {
            text: ' آمار فعالیت ها'
        },
        labels: {
            formatter: function () {
                return this.value ;
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: false
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [
        {
            // LINE CHART FOR ANNOUNCEMENTS
            name: ' تبلیغات',
            marker: {
                symbol: 'Circle'
            },
            data: [{
                y:{{reset($Announcements)}},
                marker: {
                    symbol: ' '
                }
            },
            // loadAnnouncements data 

            <?php array_shift($Announcements)?>
            @foreach($Announcements as $Announcement)
            {{$Announcement.','}}         
            @endforeach  
            ]
            
        },// END OF COURSES LINE ANNOUNCEMENTS

        {
            // LINE CHART FOR ANNOUNCEMENTS
            name: ' گروپ ها',
            marker: {
                symbol: 'Circle'
            },
            data: [{
                y:{{reset($Groups)}},
                marker: {
                    symbol: ' '
                }
            },
            // loadAnnouncements data 

            <?php array_shift($Groups)?>
            @foreach($Groups as $Group)
            {{$Group.','}}         
            @endforeach  
            ]
        
        },// END OF COURSES LINE ANNOUNCEMENTS
     
    {

            // LEAVES LINE

            name: 'تاجیلی ها',
            marker: {
                symbol: 'Circle'
            },
            data: [{
                y:{{reset($Leaves)}},
                marker: {
                    symbol: ' '
                }
            },

            // load leaves data 
            <?php array_shift($Leaves)?>
            @foreach($Leaves as $Leave)
            {{$Leave.','}}         
            @endforeach  
            ]
     },// END leaves LINE

    {

        // LINE CHART FOR DROPOUTS
        name: ' منفکی ها',
        marker: {
            symbol: 'Circle'
        },
        data: [{
            y:{{reset($Dropouts)}},
            marker: {
                symbol: ' '
            }
        },
        // load DROPOUT data 

        <?php array_shift($Dropouts)?>
         @foreach($Dropouts as $Dropout)
         {{$Dropout.','}}         
        @endforeach  
        ]
        
    },// END OF COURSES LINE DROPOUTS

    {
        // LINE CHART FOR TARANSFERS
        name: ' تبدیلی ها',
        marker: {
            symbol: 'Circle'
        },
        data: [{
            y:{{reset($Taransfers)}},
            marker: {
                symbol: ' '
            }
        },
        // load TARANSFER data 

        <?php array_shift($Taransfers)?>
         @foreach($Taransfers as $Transfer)
         {{$Transfer.','}}         
        @endforeach  
        ]
        
    },// END OF COURSES LINE TARANSFERS




    {
        // LINE CHART FOR COURSES
        name: 'صنف ها ',
        marker: {
            symbol: 'Circle'
        },
        data: [{
            y:{{reset($Courses)}},
            marker: {
                symbol: ' '
            }
        },
        // load subject data 

        <?php array_shift($Courses)?>
         @foreach($Courses as $Course)
         {{$Course.','}}         
        @endforeach  
        ]
        
    },// END OF COURSES LINE CHART

        
    {
        // SUNJECT LINE
        name: 'مضامین',
        marker: {
            symbol: 'Circle'
        },
        data: [{
            y:{{reset($subjects)}},
            marker: {
                symbol: ' '
            }
        },
        // load subject data 

        <?php array_shift($subjects)?>
         @foreach($subjects as $subject)
         {{$subject.','}}         
        @endforeach  
        ]
        
    },// END SUBJECT LINE CHART

    {
         //  LINE CHART FOR TEACHER
        name: 'استادها',
        marker: {
            symbol: 'Circle'
        },
        data: [{
            y:{{reset($teachers)}},
            marker: {
                symbol: ''
            }
        }, 
          // LOAD DATA
      <?php
     array_shift($teachers) ;
     ?>
         @foreach($teachers as $teacher)
         {{$teacher.','}}
         @endforeach
          ]
        // END TEACHER LINE CHART
    },

    {
         // USERS LINE CAHRT
        name: 'کاربر',
        marker: {
            symbol: 'Circle'
        },
        data: [{
          
           y:{{reset($users)}},
            marker: {
                symbol: ''
            }
        },  
        // LOAD DATA
     <?php
     array_shift($users) ;
     ?>
         @foreach($users as $user)
        {{$user.','}} 
        @endforeach
        
     ]

    }// END USERS LINE CAHRT

    ]
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