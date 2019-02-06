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
	<div class="page">
		<table class="header_table"  style="width:100%;">
			<tr>
				<td  style="text-align:right;width:33%;vertical-align:bottom;">
                    <h4>{{trans('general.Involvement_request')}}</h4>
				</td>
				<td style="text-align:center;width:33%;vertical-align:top;">
					<img src="{{ asset('img/wezarat-logo.jpg') }}"  style="max-width: 80px"/>
					<p style="margin-top:5px;font-size: 14px">{{trans('general.MOHE')}}</p>				
					<p style="margin-top:5px;">پوهنتون {{ $student->university->name }}</p>
					<p style="margin-top:5px;">دیپارتمنت : {{ $student->department->name }}</p>				
				</td>	
				<td style="text-align:right;width:33%;padding-right:17%;vertical-align:top;padding-top:1%;" >					
					<img src="{{ file_exists($student->photo_url) ? asset($student->photo_url) : asset('img/avatar-placeholder.png') }}" style="max-width: 100px">
				</td>				
			</tr>
		</table>
		<hr>
		<h4 style ="padding-right:10px"> {{trans('general.to_university_board')}}{{$student->university->name}}</h4>
		<p style="text-align: justify; padding-right:10px">
		{{trans('general.my_self')}}{{$student->getFullNameAttribute()}}{{trans('general.my_father_name')}}{{$student->father_name}}{{trans('general.semister')}}{{$request->semister}}
		{{trans('general.year_of_study')}}{{$request->year}} {{trans('general.due_to')}} ( &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;)
		{{trans('general.could_not_carry_on')}}<br>
		{{trans('general.reinvolvement_request_from_student')}}<br>
		<p class="center">{{trans('general.with_respect')}}</p>
		<p style="text-align: justify; padding-right:10px"> {{trans('general.student_name')}}: {{$student->name}} ....................................... امضا:............................................. تاریخ : /&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;/&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;/ </p>
	<br>
	<hr>
	<h4 style ="padding-right:10px"> {{trans('general.to_faculty_board')}}{{$student->department->name}}</h4>
	<p style="text-align: justify; padding-right:10px">{{trans('general.request_to_faculty_for_reinvo')}} &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; {{trans('general.with_respect')}} </p> 
	<p class="center">{{trans('general.student_affair_name')}}</p>
	<p style="text-align: justify; padding-right:10px"> {{trans('general.name')}}: ........................................................... امضا:.............................................	.............. تاریخ : /&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;/&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;/ </p>
	<hr>
	<table class="table" style="margin-top: 20px">
			<tr>
				<td class="bg-grey" style = "width:200px">{{trans('general.name')}}</td>
				<td></td>
			</tr>
			<tr>
				<td class="bg-grey" style = "width:200px">{{trans('general.last_name')}}</td>
				<td></td>
			</tr>
			<tr>
				<td class="bg-grey">{{trans('general.father_name')}}</td>
				<td></td>
			</tr><tr>
				<td class="bg-grey">{{trans('general.grandfather_name')}}</td>
				<td></td>
			</tr><tr>
				<td class="bg-grey">{{trans('general.kankor_year')}}</td>
				<td></td>
			</tr><tr>
				<td class="bg-grey">{{trans('general.kankor_score')}} </td>
				<td></td>
			</tr><tr>
				<td class="bg-grey">{{trans('general.kankor_id')}}</td>
				<td></td>
			</tr><tr>
				<td class="bg-grey"> {{trans('general.department')}}</td>
				<td> </td>
			</tr><tr>
				<td class="bg-grey" > {{trans('general.kankor_result')}}</td>
				<td></td>
			</tr>
			<tr>
				<td class="bg-grey" > {{trans('general.does_student_enro')}}</td>
				<td></td>
			</tr>
			<tr>
				<td class="bg-grey" > {{trans('general.if_student_has_leave_or_transfer_before')}}</td>
				<td></td>
			</tr>
			<tr>
				<td class="bg-grey" > {{trans('general.reason_of_difference')}}</td>
				<td></td>
				<br><br>
			</tr>
			<tr>
				<td  class="bg-grey"><p> {{trans('general.faculty_affair_re_name_sign')}}  </p></td>
				<td class="center"; style="text-align:center">.................................................</td> 
				<br><br><br><br>
			</tr>
			<tr>
				<td class="bg-grey"><p> {{trans('general.faculty_chairman_name_sign')}} </p></td>
				<td class="center" style="text-align:center"	>.................................................</td> <br><br><br><br>
			</tr>
			<tr>
				<td class="bg-grey"><p> {{trans('general.reinvo_confirmation')}} </p></td>
				<td class="center" style="text-align:center">امضا:.................................................</td> <br><br><br><br>
			</tr>
		</table>
</div>
</body>
</html>
	