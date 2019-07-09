<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style>
	body {
		direction: ltr;
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Arial";
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
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    @page {
        size: A4;
        margin: 0;
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
            page-break-after: always;
        }
    }
	p {
		margin:0;
	}
	.table td,.table th{	    
	    padding:3px 3px; 	        
		border: 1px solid #000;
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
	table.noBorder tr td {
  		border: 0;
	}
	table.boldText tr td {
		font-weight:bold
	}
	tr.smallText th  {
		font-size:11px;
		font-weight: bold;
	}
	tr.smallTexttd td  {
		font-size:12px
	}
	tr.alignment th   {
		text-align: left;
	}
	tr.alignment td   {
		text-align: left;
	}
</style>
</head>
<body>
	@php
		$tazkira = explode('!@#', $student->tazkira);		
	@endphp
	<div class="page"style="position: relative;">
		{{-- main header --}}
		<table class="header_table"  style="width:100%; border-bottom:1px solid">
			<tr bgcolor="#F5FFFA">
                {{-- university-logo --}}
				<td style="text-align:left;width:30%;padding-left:1%;vertical-align:top;padding-top:0%;" >					
					<img src="{{ asset($student->university->logo())}}" style="max-width: 80px">
                </td>
                {{-- central-text --}}
				<td style="text-align:center;width:40%;vertical-align:top;">
					<p style="margin-top:5px;font-size: 14px">Islamic Republic of Afghanistan</p>				
					<p style="margin-top:5px;">Ministry of Higher Education</p>
					<p style="margin-top:5px;"> {{$student->university->name_eng}} </p>				
					<p style="margin-top:5px;"> Official Transcript </p>				
                </td>
                <td style="text-align:right;width:30%;padding-left:1%;vertical-align:top;padding-top:0%;" >					
                    <img src="{{ asset('img/wezarat-logo.jpg') }}"  style="max-width: 80px"/>
                </td>
                        
			</tr>
		</table>	
		{{-- studnet information header --}}
		<table class="table" style="margin-top: 5px; border-bottom:1px solid">
			<tr style="border:0">
				{{-- Information column 1 --}}
				<td style="text-align:left;width:43%;vertical-align:top; pading-left:1.5%; border:0">
					<table class="table inner-table noBorder boldText" >
						<tr>
							<td >Name:</td>
							<td>{{ $student->name }}</td>
						</tr>
						<tr>
							<td >Father Name:</td>
							<td>{{ $student->father_name }}</td>
						</tr><tr>
							<td>Department:</td>
							<td>{{ $student->department->name }}</td>
						</tr><tr>
							<td>Faculty:</td>
							<td>{{ $student->department->faculty }}</td>
						</tr>
					</table>
				</td>

				{{-- Information column 2 --}}
				<td style="text-align:left;width:43%;vertical-align:top; border:0">
					<table class="table inner-table noBorder boldText" >
						<tr>
							<td >Registration No:</td>
							<td>{{ $student->name }}</td>
						</tr>
						<tr>
							<td >Admission Date:</td>
							<td>{{ $student->father_name }}</td>
						</tr><tr>
							<td>Graduation Date:</td>
							<td>{{ $student->department->name }}</td>
						</tr><tr>
							<td>Date of Brith:</td>
							<td>{{ $student->department->faculty }}</td>
						</tr>
					</table>
				</td>
		
				{{-- student Image --}}
				<td style="text-align:center width : 10% ;right;padding-right:1%;vertical-align:top;padding-top:0%; border:0" >					
					<img src="{{asset('img/avatar-placeholder.png') }}" style="max-width: 100%; max-height: 100%">
				</td>
			</tr>					
		</table>
		<table class="table" style="margin-top: 5px;">
			
			@foreach ($scores as $semester)	
				@if($semester[0]->semester % 2 != 0)
				<tr>
				@endif
				<td style='border-right:none;border-left:none;border-bottom:none;border-top:none'>
					<table>
						<tr>
							<td style='border-right:none;border-left:none;border-bottom:none;border-top:none'>
								<table>
									<tr>
										<th style="border:none" class="center">{{$semester[0]->semester}}
											@if($semester[0]->semester == 1) <sup>st</sup>
											@elseif($semester[0]->semester == 2) <sup>nd</sup>
											@elseif($semester[0]->semester == 3) <sup>rt</sup>
											@else <sup>th</sup>
											@endif Semister(Year {{$semester[0]->created_at->year}}) 
										</th>
									</tr>	
								{{-- end of each semester header --}}
									<tr>
										<td style="width:40%;vertical-align:top; height:390px; pading-left:0;border-left: 0px ;border-top:0px ;border-bottom:0px  solid #cdd0d4 ; border-right: 1px solid #cdd0d4; position: static; ">	
											<table class="table inner-table noBorder boldText" >
													<tr class="smallText alignment" style="border:1px solid">
														<th style="border:none; ">No</th>
														<th style="border:none; width:40% ">Subject</th>
														<th style="border:none; ">Credits</th>
														<th style="border:none; ">Credit HRS</th>
														<th style="border:none; ">Marks</th>
														<th style="border:none; ">Grade</th>
													</tr>
												@php 
													$total_score = 0 ;
													$total_credit = 0;
												@endphp
												@foreach ($semester as $score)
												@php
													$total_score   = $total_score + ( $score->total * $score->subject->credits);
													$total_credit   = $total_credit + $score->subject->credits;
												@endphp
													<tr class="smallTexttd alignmenttd" style="padding-top:5px; " >
														<td style="border:none; ">{{$loop->iteration}}</td>
														<td style="border:none; ">{{$score->subject->title}}</td>
														<td style="border:none; ">{{$score->subject->credits}}</td>
														<td style="border:none; ">{{$score->subject->credits * 16}}</td>
														<td style="border:none; ">{{$score->total}}</td>
														<td style="border:none; ">
															@if($score->total <= 100 and $score->total >= 90) A
															@elseif($score->total <= 80 and $score->total >= 89) B 
															@elseif($score->total <= 70 and $score->total >= 79) C 
															@else D 
															@endif
														</td>
													</tr>
												@endforeach 
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr style="vertical-align: bottom;">
							<table class="table inner-table noBorder boldText" bgcolor="#DCDCDC	">
									<tr><p style="font-weight:bold;  padding-left:10px; vertical-align: bottom">Total Credits: <span style="padding-left:55px"> {{$total_credit}}</span></p></tr>
									<tr class="smallTexttd">
										<td style="">Average Percentage SGPA</td>
										<td style="">{{round($total_score/ $total_credit,2)}}</td>
										<td style="">Result</td>
										<td style="">passed</td>
									</tr>
							</table>
						</tr>
					</table>
				</td>
				@if($semester[0]->semester % 2 == 0)
				</tr>
				@endif	
		@endforeach						
	</table>
		

		{{-- Fotter Section --}}
		<table class="table noBorder" style="margin-top: 20px;">
			<tr>
				<td>A = 90-100 Marks</td>
			</tr>
			<tr>
				<td>B = 80-89 Marks</td>
			</tr>
			<tr>
				<td>C = 70-79 Marks</td>
			</tr>
			<tr>
				<td>D = 55-69 Marks</td>
			</tr>
			<tr>
				<td style="width:100%"><strong>SGPA</strong> = Semester Grade Point Average</td>
			</tr>
			<tr>
				<td style="width:100%"><strong>CGPA</strong> = Cumulative Grade Point Average</td>
			</tr>
		</table>	
		<div  style=" 
		bottom: 10%; 
		top : 20px;
		width: 100%;" >
		<table class="table noBorder" >
			<tr>
				<td style="text-align:left; width:30%; text-decoration: underline "> Academic Register</td> 
				<td style="text-align:center; width:30%;text-decoration: underline"> Dean of Faculty</td>
				<td style=" width:60%; text-decoration: underline">Vice-Chancellor of Student Afffair</td>
			</tr>
		</table>
		</div>
		</div>
    </div>		
	<script>
		// window.print();
	</script>
</body>
</html>	