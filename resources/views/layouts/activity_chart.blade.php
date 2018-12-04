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
                {!! Form::open(['route' => 'home.getActivityByUniversity', 'method' => 'post']) !!}  
                <div class="col-md-3 col-sm-4">
                    <select name="universities" id="" class="form-control" style="width: 80% !important; margin-top:16px;"  >
                    @foreach($allUniversities as $university)
                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                        @endforeach
                    </select>
                </div>

               
               
                    <div class="form-group col-md-3">
                        <label>Start Date: </label>
                        <div  class="input-group date  datepic" data-date-format="yyyy-mm-dd">
                            <input class="form-control timepicker" name="startdate" type="text" readonly  />
                            <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-3" >
                        <label>End Date: </label>
                        <div  class="input-group date  datepic" data-date-format="yyyy-mm-dd">
                            <input class="form-control timepicker" name="enddate" type="text" readonly />
                            <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                        </div>
                        
                    </div>
                    
         
                
                <div class="col-md-1 col-sm-2">
                    <br>
                    <button type="submit" class="btn green">show</button>
                </div>

  {!! Form::close() !!}
  

            </div>
            <div id="activity-chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
        <script type="text/javascript">  
            Highcharts.chart('activity-chart', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'گراف فعالیت های ۷ روز گذشته'
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
            name: ' ?منفکی ها',
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
            name: ' تیدیلی ها',
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




<!-- Ajax methdd to update data on province change for the province specific column chart -->
<script src="{{ asset('js/ajaxCharts.js') }}" type="text/javascript"></script>

@endsection



@push('scripts')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
    function kankorYear(value){
        
        var year = value;

        window.location.href = window.location.origin + "/home/" + year;

    }

    $(function () {
      $(".datepic").datepicker({ 
        autoclose: true, 
        todayHighlight: true
    }).datepicker('update', new Date());
  });

</script>


@endpush