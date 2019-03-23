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
                    <h4>{{trans('general.transfer_form')}}</h4>

				</td>		
				<td style="text-align:center;width:33%;vertical-align:top;">
					<img src="{{ asset('img/wezarat-logo.jpg') }}"  style="max-width: 80px"/>
					<p style="margin-top:5px;font-size: 14px">{{trans('general.ministry_title')}}</p>				
					<p style="margin-top:5px;">پوهنتون {{ $student->university->name }}</p>				
				</td>	
				<td style="text-align:right;width:33%;padding-right:17%;vertical-align:top;padding-top:1%;" >					
					<img src="{{ file_exists($student->photo_url) ? asset($student->photo_url) : asset('img/avatar-placeholder.png') }}" style="max-width: 100px">
				</td>				
			</tr>
		</table>
		<table class="table" style="margin-top: 20px">
			<tr>
                 <td>
                     بریاست محترم پوهنتون {{$student->university->name}}!
                </td>
                <br>
                <br>
			</tr>
			<tr>
				<td style="padding: 0">
					<table class="table inner-table">
						<tr>
							<td class="bg-grey"  style = "width:15%" > {{trans('general.name')}}</td>
							<td  style = "width:15%" >{{ $student->getFullNameAttribute() }}</td>
							<td class="bg-grey"  style = "width:10%" >{{trans('general.father_name')}}</td>
							<td style = "width:15%" >{{ $student->father_name }}</td>
							<td class="bg-grey" style = "width:15%"  > {{trans('general.grandfather_name')}}</td>
							<td style = "width:20%">{{ $student->grandfather_name }}</td>
						</tr>
                        <tr>
							<td class="bg-grey" > {{trans('general.general_number')}}  </td>
							<td>{{ $tazkira[3] ?? '' }}</td>
							<td class="bg-grey" > {{trans('general.page')}}  </td>
							<td>{{ $tazkira[2] ?? '' }}</td>
							<td class="bg-grey"  >{{trans('general.volume')}} </td>
							<td>{{ $tazkira[0] ?? '' }}</td>
						</tr>
						<tr>
							<td class="bg-grey"> {{trans('general.kankor_id')}}   </td>
							<td>{{ $student->form_no }}</td>
							<td class="bg-grey"  > {{trans('general.kankor_score')}}  </td>
							<td>{{ $student->kankor_score }}</td>
							<td class="bg-grey"  style = "width:33%"> {{trans('general.kankor_year')}} </td>
							<td>{{ $student->kankor_year }}</td>
						</tr>
						<tr>
							<td class="bg-grey" > {{trans('general.semister')}}    </td>
							<td>{{ $request->semister}}</td>
							<td class="bg-grey"  >  {{trans('general.faculty')}}    </td>
							<td>{{ $student->kankor_result }}</td>
							@if($model != null)
							<td class="bg-grey" >  {{trans('general.to_department_detailse')}}</td>
							<td>پوهنتون : {{ $model->toDepartment->university->name  }} دیپارتمنت {{ $model->toDepartment->name }}</td>
							@else
							<td class="bg-grey" >  {{trans('general.to_department_detailse')}}</td>
							<td>پوهنتون :  دیپارتمنت </td>
							@endif
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table class="table inner-table borderless" style >
						<tr>
							<td style= " padding-top: 0px; border:none ; padding-right:10px" >                                                                                                                                               
								<p>{{trans('general.form_text_for_student')}} &nbsp; &nbsp; &nbsp; {{trans('general.with_respect')}}  </p>
							</td><br>
						</tr>
						<tr>
							<td style= "border:none ; padding-right:20px"><p>  {{trans('general.student_name')}}    :&nbsp; {{$student->getFullNameAttribute()}} &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : {{jalaliDate()}}</span></p></td><br>
						</tr>
						<tr>
							<td style= " padding-top: 0px; border:none ; padding-right:10px" >                                                                                                                                               
								<p>{{trans('general.transfer_student_affair_text')}} &nbsp; &nbsp; &nbsp; {{trans('general.with_respect')}}  </p>
							</td><br>
						</tr>
						<tr>
							<td style= " padding-top: 0px; border:none ; text-align:center" >                                                                                                                                               
								<p>{{trans('general.student_affair_name')}}  </p>
							</td><br>
						</tr>
						<tr>
							<td style= "border:none ; padding-right:10px"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : {{jalaliDate()}}</span></p></td><br>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<table class="table" style="margin-top: 20px">
			<tr>
                 <td>
                     {{trans('general.faculty_information_about_student')}}
                </td>
                <br>
                <br>
			</tr>
			<tr>
				<td style="padding: 0">
					<table class="table inner-table">
						<tr>
							<td class="bg-grey"  style = "width:10%" > {{trans('general.name')}}</td>
							<td  style = "width:20%" ></td>
							<td class="bg-grey"  style = "width:20%" >{{trans('general.last_name')}}</td>
							<td style = "width:15%" ></td>
							<td class="bg-grey" style = "width:15%"  > {{trans('general.father_name')}}</td>
							<td style = "width:15%"></td>
						</tr>
                        <tr>
							<td class="bg-grey" > {{trans('general.grandfather_name')}}  </td>
							<td></td>
							<td class="bg-grey"> {{trans('general.kankor_id')}}   </td>
							<td></td>
							<td class="bg-grey"  >{{trans('general.kankor_score')}} </td>
							<td></td>
						</tr>
						<tr>
							<td class="bg-grey"> {{trans('general.kankor_year')}}   </td>
							<td></td>
							<td class="bg-grey"  > {{trans('general.is_transfer')}}  </td>
							<td></td>
							<td class="bg-grey"  style = "width:33%"> {{trans('general.resolve_transfer')}} </td>
							<td></td>
						</tr>
						<tr>
							<td class="bg-grey" > {{trans('general.to_department_detailse')}}   </td>
							<td></td>
							<td class="bg-grey"  >  {{trans('general.accept_or_refuse')}}    </td>
							<td></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table class="table inner-table borderless" style >
						<tr>
							<td style= " padding-top: 0px; border:none ; padding-right:10px" >                                                                                                                                               
								<p>{{trans('general.faculty_affair_re_name_sign')}}  </p>
							</td><br>
						</tr>
						<tr>
							<td style= "border:none ; padding-right:20px"><p>  {{trans('general.name')}}    :&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/ </span></p></td><br>
						</tr>
						<tr>
							<td style= " padding-top: 0px; border:none ; padding-right:10px" >                                                                                                                                               
								<p>{{trans('general.faculty_chairman_name_sign')}}  </p>
							</td><br>
						</tr>
						<tr>
							<td style= "border:none ; padding-right:20px"><p>  {{trans('general.name')}}    :&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/ </span></p></td><br>
						</tr>
	
	
					</table>
				</td>
			</tr>
		</table>


		<table class="table" style="margin-top: 20px">
			<tr>
                 <td>
                     {{trans('general.to_faculty_board')}}:..................
                </td>
                <br>
			</tr>
			<tr>
				<td style= " padding-top: 10px; border:none ; padding-right:10px" >                                                                                                                                               
					<p>{{trans('general.transfer_to_deparment_approve_request')}}  &nbsp;&nbsp; {{trans('general.with_respect')}}  </p>
				</td><br>
			</tr>
			<tr>
				<td style= " padding-top: 0px; border:none ; text-align:center" >                                                                                                                                               
					<p>{{trans('general.student_affair_name')}}  </p>
				</td><br>
			</tr>
			<tr>
				<td style= "border:none ; padding-right:10px"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td><br>
			</tr>
		</table>
		<p>{{trans('general.faculty_opinion')}}:</p>
		<table class="table" style="margin-top: 5px">
			<tr>
                <td>
                </td>
				<br><br><br><br><br>
			</tr>
			<tr>
				<td style= " padding-top: 10px; border:none ; text-align:center" >                                                                                                                                               
					<p>{{trans('general.faculty_chairman_name_sign_only')}}  </p>
				</td><br>
			</tr>
			<tr>
				<td style= "border:none ; padding-right:10px"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td><br>
			</tr>
		</table>
		<hr>
		<p>{{trans('general.final_decision_of_board')}}:</p>
		<table class="table" style="margin-top: 5px">
			<tr>
                <td>
                
                </td>
				<br><br><br><br><br>
			</tr>
			<tr>
				<td>
					<table class="table inner-table borderless" style >
						<tr>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								{{trans('general.member_of_decision_board')}}  
							</td>
							<td style= "border:none ; padding-right:10px"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td>
						</tr>
						<tr>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								{{trans('general.member_of_decision_board')}}  
							</td>
							<td style= "border:none ; padding-right:10px"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td>
						</tr><tr>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								{{trans('general.member_of_decision_board')}}  
							</td>
							<td style= "border:none ; padding-right:10px"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td>
						</tr><tr>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								{{trans('general.member_of_decision_board')}}  
							</td>
							<td style= "border:none ; padding-right:10px"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td>
						</tr><tr>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								{{trans('general.member_of_decision_board')}}  
							</td>
							<td style= "border:none ; padding-right:10px"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td>
						</tr><tr>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								{{trans('general.member_of_decision_board')}}  
							</td>
							<td style= "border:none ; padding-right:10px"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<p>{{trans('general.university_confirmation')}}:</p>
		<p>  {{trans('general.sign_stamp_date')}}    :&nbsp; ...........................   &nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p>

    </div>	
</body>
</html>
	