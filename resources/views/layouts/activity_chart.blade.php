@extends('layouts.app')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="col-md-1 col-sm-4">
                    <h3 style="text-align: left">پوهنتون:</h3>
                </div>
                <div class="col-md-2 col-sm-4">
                    <select name="university" id="university" class="form-control" style=" margin-top:16px;"  >
                    @if($uniname == "")
                    <option value="0">تمام پوهنتون ها</option>
                    @else
                    <option value="{{$university_id}}">{{$uniname}}</option>
                    @endif
                    @foreach($allUniversities as $university)
                        <option value ="{{ $university->id }}">{{ $university->name }}</option>
                        @endforeach
                        <option value="0">تمام پوهنتون ها</option>
                    </select>

                </div>
                <div class="col-md-1 col-sm-4">
                    <h3 style="text-align: left">از تاریخ</h3>
                </div>
               
                <div class="col-md-2 col-sm-4">
                <br>
                <div  class="input-group date  datepic" data-date-format="yyyy-mm-dd">
                            <input class="form-control timepicker" name="startdate" id = "startdate" type="text" readonly style=""  />
                            <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                        </div>
                </div>
                <div class="col-md-1 col-sm-4">
                    <h3 style="text-align: left">الی تاریخ</h3>
                </div>
               
                <div class="col-md-2 col-sm-4">
                <br>
                <div  class="input-group date  datepic" data-date-format="yyyy-mm-dd">
                            <input class="form-control timepicker" name="enddate" id = "enddate" type="text" readonly  />
                            <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                        </div>
                </div>

                <div class="col-md-1 col-sm-2">
                    <br>
                    <button type="button" class="btn green" onclick = "getUniversityActivity()">{{trans('general.activity_show')}}</button>
                </div>
            </div>
            <br>
            <br>
            <div id="activity-chart" style="min-width: 310px; height: 400px; margin: 0 auto;"></div>
        </div>
        <script type="text/javascript">  
            Highcharts.chart('activity-chart', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'گراف فعالیت های'+{{$diff}}+' روز گذشته'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: [

             @foreach($dates as $key => $value)
              
              "{{$key}}",
                  
               @endforeach 
                    ]
                    
                },
                yAxis: {
                    title: {
                        text: ' امار فعالیت ها'
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
                    @php
                    if($groups)
                    {
                    @endphp
                {
            // LINE CHART FOR GROUPS
            name: ' گروپ ها',
            marker: {
                symbol: 'Circle'
            },
            data: [{
                y:{{reset($groups)}},
                marker: {
                    symbol: ' '
                }
            },
            // loadAnnouncements data 

            <?php array_shift($groups)?>
            @foreach($groups as $group)
            {{$group.','}}         
            @endforeach  
            ]
            
        },// END OF COURSES LINE GROUPS
        @php
         }
        if($leaves)
        {
        @endphp
        {

            // LEAVES LINE

            name: 'تاجیلی ها',
            marker: {
                symbol: 'Circle'
            },
            data: [{
                y:{{reset($leaves)}},
                marker: {
                    symbol: ' '
                }
            },

            // load leaves data 
            <?php array_shift($leaves)?>
            @foreach($leaves as $leave)
            {{$leave.','}}         
            @endforeach  
            ]
        },// END leaves LINE
        @php
            }   
            if($dropouts)
            {
        @endphp
        {

            // LINE CHART FOR DROPOUTS
            name: ' منفکی ها',
            marker: {
                symbol: 'Circle'
            },
            data: [{
                y:{{reset($dropouts)}},
                marker: {
                    symbol: ' '
                }
            },
            // load DROPOUT data 

            <?php array_shift($dropouts)?>
            @foreach($dropouts as $dropout)
            {{$dropout.','}}         
            @endforeach  
            ]
            
        },// END OF COURSES LINE DROPOUTS
        @php
        }
        if($transfers)
        {
        @endphp
                {
            // LINE CHART FOR TARANSFERS
            name: ' تیدیلی ها',
            marker: {
                symbol: 'Circle'
            },
            data: [{
                y:{{reset($transfers)}},
                marker: {
                    symbol: ' '
                }
            },
            // load TARANSFER data 

            <?php array_shift($transfers)?>
            @foreach($transfers as $transfer)
            {{$transfer.','}}         
            @endforeach  
            ]
            
        },// END OF COURSES LINE TARANSFERS

            @php
            }
            @endphp


        {
            // LINE CHART FOR COURSES
            name: 'صنف ها ',
            marker: {
                symbol: 'Circle'
            },
            data: [{
                y:{{reset($courses)}},
                marker: {
                    symbol: ' '
                }
            },
            // load subject data 

            <?php array_shift($courses)?>
            @foreach($courses as $course)
            {{$course.','}}         
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
       name: 'کاربرها',
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


@endsection
@push('scripts')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
    function getUniversityActivity(){

        var university = document.getElementById('university').value;
        var startdate = document.getElementById('startdate').value;
        var enddate = document.getElementById('enddate').value;

        window.location.href = window.location.origin + "/Activity/" + university +'/' + startdate + '/' + enddate;

    }

    $(function () {
      $(".datepic").datepicker({ 
        autoclose: true, 
        todayHighlight: true
    }).datepicker('update', new Date());
  });

</script>
<script>


@endpush