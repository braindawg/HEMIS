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
<body>	<div class="page">
		<table class="header_table"  style="width:100%;">
			<tr>
				<td  style="text-align:right;width:33%;vertical-align:bottom;">
                    <h4>فورم درخواست برای تاجیل</h4>
				</td>		
				<td style="text-align:center;width:33%;vertical-align:top;">
					<img src="{{ asset('img/wezarat-logo.jpg') }}"  style="max-width: 80px"/>
					<p style="margin-top:5px;font-size: 14px">{{trans('general.ministry_title')}}</p>				
					<p style="margin-top:5px;">پوهنتون {{ $student->university->name }}</p>
					<p style="margin-top:5px;">دیپارتمنت : {{ $student->department->name }}</p>				
				</td>	
				<td style="text-align:right;width:33%;padding-right:17%;vertical-align:top;padding-top:1%;" >					
					<img src="{{ file_exists($student->photo_url) ? asset($student->photo_url) : asset('img/avatar-placeholder.png') }}" style="max-width: 100px">
				</td>				
			</tr>
		</table>
		<table class="table" style="margin-top: 20px">
			<tr>
                 <td>
                     {{trans('general.to_universityـofficial')}} {{$student->university->name}}!
                </td>
                <br>
                <br>
			</tr>
			<tr>
				<td style="padding: 0">
					<table class="table inner-table">
						<tr>
							<td class="bg-grey" style = "width:200px">{{trans('general.name')}}</td>
							<td>{{ $student->getFullNameAttribute() }}</td>
						</tr>
                        <tr>
							<td class="bg-grey">{{trans('general.father_name')}}</td>
							<td>{{ $student->father_name }}</td>
						</tr><tr>
							<td class="bg-grey">{{trans('general.kankor_id')}}</td>
							<td>{{ $student->form_no }}</td>
						</tr><tr>
							<td class="bg-grey">{{trans('general.kankor_score')}}</td>
							<td>{{ $student->kankor_score }}</td>
						</tr><tr>
							<td class="bg-grey">{{trans('general.feild')}} </td>
							<td>{{ $student->kankor_result }}</td>
						</tr><tr>
							<td class="bg-grey">{{trans('general.kankor_year')}}</td>
							<td>{{ $student->kankor_year }}</td>
						</tr><tr>
							<td class="bg-grey"> {{trans('general.semister')}}</td>
							<td> {{ $request->semister }}</td>
						</tr><tr>
							<td class="bg-grey" >  {{trans('general.reason_of_leave')}} </td>
							<td></td><br><br>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table class="table inner-table borderless" style >
						<tr>
							<td style= " padding-top: 0px; border:none ; padding-right:10px" >                                                                                                                                               
								<p>	{{trans('general.student_aknowledgment_to_form')}} .</p>
							</td><br>
						</tr>
						<tr>
							<td class= "center" style= "border:none ;" ><p>{{trans('general.with_respect')}}</p></td>
						</tr>
						<tr>
							<td style= "border:none ; padding-right:20px"><p> {{trans('general.student_name')}} :&nbsp; {{$student->getFullNameAttribute()}} &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> {{trans('general.date')}} : {{jalaliDate()}}</span></p></td><br>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table class="table inner-table borderless" style >
						<tr>
							<td style= " padding-top: 0px; border:none ; padding-right:10px" >                                                                                                                                               
								<p>{{trans('general.to_facultyـofficial')}}: {{$student->department->name}} !</p>
							</td>
						</tr>
						<tr>
							<td  style= "border:none ; padding-right:10px" ><p>{{trans('general.student_afair_request_to_faculty')}}. &nbsp;&nbsp;{{trans('general.with_respect')}}</p></td><br>
						</tr>
						<tr>
							<td style= "border:none ; padding-right:20px"><p> {{trans('general.student_affair_name')}} :&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> {{trans('general.date')}} : /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td><br>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table class="table inner-table borderless"  >
						<tr>
							<td style= " padding-top: 0px; border:none ; padding-right:10px" >                                                                                                                                               
								<p> {{trans('general.faculty_request_to_department')}}  </p>
							</td><br>
						</tr>
						<tr>
							<td  style= "border:none ; padding-right:10px" ><p></p><br><br><br></td>
						</tr>
						<tr>
							<td style= "border:none ; padding-right:20px"><p>   {{trans('general.faculty_chairman_name_sign')}}:&nbsp;  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{trans('general.date')}} : /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td><br><br>
						</tr> <tr>
							<td style= "border:none ; padding-right:20px"><p>    {{trans('general.faculty_affair_re_name_sign')}} :&nbsp;  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{trans('general.date')}} : /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td><br>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table class="table inner-table borderless"  >
						<tr>
							<td style= " padding-top: 0px; border:none ; padding-right:10px" >                                                                                                                                               
								<p>{{trans('general.university_confirmation')}} :  </p>
							</td><br>
						</tr>
						<tr>
							<td style= "border:none ; padding-right:20px"><p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> {{trans('general.date')}} : /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ </span></p></td>
						</tr>
					</table>
				</td>
			</tr>

		</table>
    </div>	
</body>
</html>
	