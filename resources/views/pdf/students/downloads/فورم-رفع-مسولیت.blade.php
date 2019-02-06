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
                    <h4>{{trans('general.disclaimer_form')}}</h4>

				</td>		
				<td style="text-align:center;width:33%;vertical-align:top;">
					<img src="{{ asset('img/wezarat-logo.jpg') }}"  style="max-width: 80px"/>
					<p style="margin-top:5px;font-size: 14px">{{trans('general.ministry_title')}}</p>				
					<p style="margin-top:5px;">پوهنتون {{ $student->university->name }}</p>				
					<p style="margin-top:5px;"> {{trans('general.student_affair_authority')}}</p>				
				</td>	
				<td style="text-align:right;width:33%;padding-right:17%;vertical-align:top;padding-top:1%;" >					
					<img src="{{ file_exists($student->photo_url) ? asset($student->photo_url) : asset('img/avatar-placeholder.png') }}" style="max-width: 100px">
				</td>				
			</tr>
		</table>
		<table class="table" style="margin-top: 20px">
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
							<td class="bg-grey" > {{trans('general.kankor_result')}}    </td>
							<td>{{ $student->kankor_result}}</td>
							<td class="bg-grey"  >  {{trans('general.department')}}    </td>
							<td>{{ $student->department->name}}</td>
							<td class="bg-grey" >  {{trans('general.kankor_year')}}</td>
							<td>{{ $student->kankor_year }}</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<hr>
		<table class="table" style="margin-top: 5px">
			<tr>
				<td>
					<table class="table inner-table borderless" >
						<tr>
							<th style= " padding-top: 0px ; padding-right:10px; width:10%" >                                                                                                                                               
								{{trans('general.number')}}  
							</th>
							<th style= " padding-top: 0px ; padding-right:10px; width:20%" >                                                                                                                                               
								{{trans('general.refrence')}}  
							</th>
							<th style= " padding-top: 0px ; padding-right:10px; width:40%" >                                                                                                                                               
								{{trans('general.aknowledge_disaknowledge')}}  
							</th>
							<th style= " padding-top: 0px ; padding-right:10px; width:30%" >                                                                                                                                               
								{{trans('general.sign_stamp_date')}}  
							</th>
						</tr>
						<tr>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								1
							</td>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
							 {{trans('general.hostel_administration')}}  
							</td>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								<br><br><br>
							</td>
							<td style= " padding-right:10px; hight:10%"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<br> امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td>
						</tr>
						<tr>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								۲
							</td>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
							 {{trans('general.bookstore_administration')}}  
							</td>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								<br><br><br>
							</td>
							<td style= " padding-right:10px; hight:10%"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<br> امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td>
						</tr>	<tr>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								۳
							</td>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
							 {{trans('general.IT_administration')}}  
							</td>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								<br><br><br>
							</td>
							<td style= " padding-right:10px; hight:10%"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<br> امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td>
						</tr>	<tr>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								۴
							</td>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
							 {{trans('general.relate_department')}}  
							</td>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								<br><br><br>
							</td>
							<td style= " padding-right:10px; hight:10%"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<br> امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td>
						</tr>	<tr>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								۵
							</td>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
							 {{trans('general.faculty_aknowledgment')}}  
							</td>
							<td style= " padding-top: 0px ; padding-right:10px" >                                                                                                                                               
								<br><br><br>
							</td>
							<td style= " padding-right:10px; hight:10%"><p>  {{trans('general.name')}}    :&nbsp; ........................... &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<br> امضاّ  :&nbsp;<span>...................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<p>{{trans('general.disclaimer_confirmation')}}{{trans('general.with_respect')}}</p>
		<p>  {{trans('general.student_affair_name')}} :&nbsp; .....................................   &nbsp;امضاّ &nbsp;&nbsp;<span>.........................<span> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> تاریخ : / &nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;/</span></p>

    </div>	
</body>
</html>
	