<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style>
	body {
		direction: rtl;
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
		font-family: 'nazanin';
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 5mm;
        margin: 10mm auto;
        border: 0.5px #D3D3D3 solid;
        border-radius: 2px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
        }
    }
    
	p {
		margin:0;
	}
	.table td,.table th{	    
	    padding:4px 4px; 	        
		border: 0.5px solid #000;
	}
	.inner-table tr:first-child td, .inner-table tr:first-child th {
		border-top: 0
	}
	.inner-table tr td:first-child, .inner-table tr th:first-child {
		border-right: 0
	}
	.inner-table tr:last-child td, .inner-table tr:last-child th {
		border-bottom: 0
	}
	.inner-table tr td:last-child, .inner-table tr th:last-child {
		border-left: 0
	}
	table{
	    width:100%;
		border-collapse: collapse;
	}
	.bg-grey {
		background-color: #d8d8d8;
	}
	.center {
		text-align: center;
	}
</style>
</head>
<body>
	@php
		$tazkira = explode('!@#', $student->tazkira);		
	@endphp	
	<div class="page">
		<table class="header_table"  style="width:100%;">
			<tr>
				<td  style="text-align:right;width:33%;vertical-align:bottom;">
                    <h4>{{trans('general.hostel_form1')}}</h4>
				</td>
				<td style="text-align:center;width:33%;vertical-align:top;">
					<img src="{{ asset('img/wezarat-logo.jpg') }}"  style="max-width: 80px"/>
					<p style="margin-top:5px;font-size: 14px">{{trans('general.MOHE')}}</p>				
					<p style="margin-top:5px;">پوهنتون {{ $student->university->name }}</p>
					<p style="margin-top:5px;"> {{trans('general.student_affair_authority')}}</p>				
				</td>	
				<td style="text-align:right;width:33%;padding-right:17%;vertical-align:top;padding-top:1%;" >					
					<img src="{{ file_exists($student->photo_url) ? asset($student->photo_url) : asset('img/avatar-placeholder.png') }}" style="max-width: 100px">
				</td>				
			</tr>
		</table>
		<hr>
		<p style="text-align: justify; padding-right:10px">
		{{trans('general.name')}}:{{$student->getFullNameAttribute()}}  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;{{trans('general.father_name')}}:{{$student->father_name}}
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;{{trans('general.grandfather_name')}}:{{$student->grandfather_name}}
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;{{trans('general.school_name')}}:{{$student->school_name}}
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;{{trans('general.school_graduation_year')}}:{{$student->school_graduation_year}}<br>
		{{trans('general.date')}}:{{jalaliDate()}}
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;{{trans('general.kankor_id')}}:{{$student->form_no}}
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;{{trans('general.kankor_score')}}:{{$student->kankor_score}}
		<hr>
		<p> {{trans('general.student_addressـinformation')}}	 <p>
		<table class="table" style="margin-top: 1px">
		<tr>
			<th class="">{{trans('general.student_address')}}</th>
			<th class="">{{trans('general.address')}}</th>
			<th class="">{{trans('general.village')}}</th>
			<th class="">{{trans('general.district')}}</th>
			<th class="">{{trans('general.province')}}</th>
			<th class="">{{trans('general.consideration')}}</th>
		</tr>						
		<tr>
			<th class="">{{trans('general.student_resi_location')}}</th>
			<td>{{ $student->address }}</td>
			<td>{{ $student->village }}</td>							
			<td>{{ $student->district }}</td>
			<td>{{ $student->originalProvince ? $student->originalProvince->name : '' }}</td>
			<td>{{ $student->consideration }}</td>
		</tr>	
		<tr>
			<th class="">{{trans('general.student_current_location')}}</th>
			<td>{{ $student->address_current }}</td>
			<td>{{ $student->village_current }}</td>							
			<td>{{ $student->district_current }}</td>
			<td>{{ $student->consideration }}</td>
			<td>{{ $student->currentProvince ? $student->currentProvince->name : '' }}	</td>
		</tr>		
		</table>
		<div style = "border:1px solid black; margin-botome:10px;"> 
		<p style ="padding:5px; ">{{trans('general.tazkira_information')}} 
			 {{trans('general.general_number')}} : {{ $tazkira[3] ?? '' }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
			{{trans('general.page')}} : {{ $tazkira[2] ?? '' }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
			{{trans('general.volume')}} : {{ $tazkira[0] ?? '' }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
			{{trans('general.registration_number')}} : {{ $tazkira[1] ?? '' }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		</p>	
		</div>

		<p> {{trans('general.student_study_location')}}	 <p>
		<table class="table" style="margin-top: 1px">
			<tr>
				<th class="">{{trans('general.grade')}}</th>
				<th class="">{{trans('general.grade10')}}</th>
				<th class="">{{trans('general.grade11')}}</th>
				<th class="">{{trans('general.grade12')}}</th>
			</tr>						
			<tr>
				<th class="">{{trans('general.location')}}</th>
				<td></td>
				<td></td>							
				<td></td>
			</tr>	
		</table>
		<table class="table" style="margin-top: 1px">
			<tr>
				<td> {{trans('general.student_father_job_and_job_location')}}</td>
				<td></td>							
			</tr>
			<tr>
				<td style =" width:50%"> {{trans('general.phone')}}</td>
				<td></td>							
			</tr><tr>
				<td> {{trans('general.student_wealth')}}</td>
				<td></td>							
			</tr><tr>
				<td> {{trans('general.student_father_wealth')}}</td>
				<td></td>							
			</tr><tr>
				<td> {{trans('general.student_husband_wife_wealth')}}</td>
				<td></td>							
			</tr>
		</table>
		<div style = "border:1px solid black; margin-bottom:10px;"> 
		<p class="center" >{{trans('general.student_obligation_for_hostel')}}</p>	
		<p style =" padding-right:10px">{{trans('general.student_obligation_statment_for_hostel')}}</p>	
		<p style ="padding-right:10px">{{trans('general.student_obligation_final_statment_for_hostel')}}. {{trans('general.with_respect')}}
		&nbsp; &nbsp; {{trans('general.student_name')}}: {{$student->name}}  &nbsp; امضا : ................. &nbsp; &nbsp; <span>{{trans('general.date')}} : /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/</span>  </p>	
		</div>

		<div style = "border:1px solid black; margin-bottom:2px;"> 
		<p class="center" >{{trans('general.faculty_aknowledgment_for_student')}}</p>	
		<p style =" padding-right:10px">{{trans('general.faculty')}} : {{$student->department->faculty}}  &nbsp;{{trans('general.student_enrollment')}} ({{$student->department->name}})&nbsp; &nbsp;
		{{trans('general.semister')}} ({{$request->semister}}) &nbsp;  {{trans('general.and')}} {{trans('general.year')}} ({{$student->kankor_year}})    &nbsp; {{trans('general.clarify')}}. {{trans('general.with_respect')}}   </p>	
		<table class="table inner-table borderless" style >
			<tr>
				<td style= " padding-top: 0px; border:none ; padding-right:10px" >                                                                                                                                               
					{{trans('general.faculty_affair_re_name_sign')}}
				</td>
			</tr>
			<tr>
				<td style= "border:none ; padding-right:20px">  {{trans('general.name')}}    :&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/ </span></td><br>
			</tr>
			<tr>
				<td style= " padding-top: 0px; border:none ; padding-right:10px" >                                                                                                                                               
					{{trans('general.faculty_chairman_name_sign')}}  
				</td>
			</tr>
			<tr>
				<td style= "border:none ; padding-right:20px"> {{trans('general.name')}}    :&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/ </span></td><br>
			</tr>
			<tr>
				<td style= " padding-right:20px; border:1px solid black;"  ><p>  {{trans('general.final_decision_of_board')}}: </td><br><br><br><br><br>
			</tr>
				</table>
		</div>
		
	</div>
</body>
</html>
	