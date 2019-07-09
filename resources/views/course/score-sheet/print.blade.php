<html>
	<head>
		<style>
			td, th, p, div, span {
				font-family: 'nazanin';
			}
			.table td,.table th{
				border:1px solid #aaa;
				padding:2px 0;
				text-align:center;
				font-size:14px;
			}
			table{
				width:100%;
				padding:2px 0;
				border-collapse: collapse;
			}
			.head td{
				padding:5px 0;
			}
			@page {
				size: auto;   /* auto is the initial value */
				margin:4cm  2% 4cm;
				margin-header: 2mm; 
				margin-footer: 5mm;
				header: html_myHeader;
				footer: html_myFooter;

			}
		</style>
	</head>
	<body style="direction: rtl;">
		<htmlpageheader name="myHeader">	
			<table>
				<tr>	
					<td style="text-align:right;width:33%">
						<h3>وزارت تحصیلات عالی</h3>
						<h3>پوهنتون {{ $course->department->university->name }}</h3>
						<h3>دیپارتمنت {{ $course->department->name }}</h3>	
					</td>
					<td style="text-align:center; width:33%;">
						<img src="{{ $course->department->university->logo() }}" style='max-width: 100px' >				
					</td>		
					<td style="vertical-align:bottom; width: 33%">
						<span style="color: #fff">.</span>
					</td>		    		
				</tr>
				<tr>	
					<td style="text-align: center; padding-top: 10px" colspan="3" >
						شقه نمرات {{ $course->grade != '' ? 'صنف '.$course->grade : '' }} سمستر {{  $course->half_year_text }} {{ $course->year != '' ? 'سال '.$course->year : '' }} {{ $course->subject ? 'مضمون '.$course->subject->title : '' }}  ({{ $course->subject ?  round($course->subject->credits) . 'کریدت' : ""}}) {{ $course->teacher ? 'استاد '.$course->teacher->full_name : '' }}
					</td>		
				</tr>
			</table>
		</htmlpageheader>

		<table  class="table" >
			<thead>
				<tr>
					<td width="35px" rowspan="2">
						شماره
					</td>
					<td style="width:100px"  colspan="2">
						شهرت
					</td>
					<td colspan="{{ 5 }}">
						نمرات  
					</td>
					<td width="100" rowspan="2">
						ملاحظات
					</td>
				</tr>
				<tr class="head">
					<td style="width:100px">
						اسم
					</td>
					<td style="width:100px">
						ولد
					</td>
					<td style="width:100px">
						فعالیت صنفی و حاضری
						<br>
						10%
					</td> 	
					<td style="width:100px">
						کار عملی و خانگی
						<br>
						10%
					</td> 	
					<td style="width:100px">
						ارزیابی وسط سمستر
						<br>
						20%
					</td> 
					<td style="width:100px">
						ارزیابی نهایی  
						<br>
						60%
					</td> 
					<td style="width:100px">
						مجموع نمرات 
						<br>
						100%
					</td> 
				</tr>
			</thead>
			<tbody>
				@php
					$passed = 0;
				@endphp

				@foreach($course->students as $student)
				
				@php
					$score = $student->relationLoaded('scores') ? $score = $student->scores->first() : null;
					$passed += $score->passed ?? 0;
				@endphp
					<tr>
						<td>
							{{ $loop->iteration }}
						</td>
						<td>
							{{ $student->fullName }}
						</td>						
						<td>
							{{ $student->father_name }}
						</td>
						<td>
							{{ $score->classwork ?? '' }}
						</td>
						<td>
							{{ $score->homework ?? '' }}
						</td>
						<td>
							{{ $score->midterm ?? '' }}
						</td>
						<td>
							{{ $score->final ?? '' }}
						</td>
						<td>
							{{ $score->total ?? '' }}
						</td>					
						<td>
						</dt>											
					</tr>    
				@endforeach
			</tbody>			
		</table>

		<htmlpagefooter name="myFooter" >
			<p>قرارجدول فوق به تعداد ({{ $course->students->count() }}) محصل شامل امتحان گردیده که ازجمله ({!! $passed > 0 ? $passed : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" !!}) محصل کامیاب و ({!! $passed > 0 ? $course->students->count() - $passed : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" !!}) ناکام میباشند.</p>
			<table style="width: 80%;">
				<tr>
					<td>امضای  ممتحن:</td>
					<td>امضای  ممیز:</td>
					<td>امضای آمر دیپارتمنت:</td>		
				</tr>
			</table>
			<br>
			<p>
			نوت: 
			از اساتید محترم جداً خواهش میگردد تا شقه امتحان خویش را سه روز بعد از اخذ امتحان به اداره پوهنحی تسلیم نمایند.
			 </p>

			<p style="text-align: left">صفحه: {PAGENO}</p>
			
		</htmlpagefooter>
	</body>
</html>

