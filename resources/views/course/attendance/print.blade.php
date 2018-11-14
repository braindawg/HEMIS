<style>
.table td,.table th{
    border:1px solid #aaa;
    padding:5px 0;
    text-align:center;
    font-size:14px;
}
table{
    width:100%;
    padding:5px 0;
    border-collapse: collapse;
}
.head td{
    padding:30px 0;
}
@page {
  	size: auto;   /* auto is the initial value */
  	margin:4cm  2% 1cm;
  	margin-header: 2mm; 
  	margin-footer: 5mm;
  	header: html_myHeader;
	footer: html_myFooter;
}
</style>

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
		    	جدول حاضری {{ $course->grade != '' ? 'صنف '.$course->grade : '' }} سمستر {{  $course->half_year_text }} {{ $course->year != '' ? 'سال '.$course->year : '' }} {{ $course->subject ? 'مضمون '.$course->subject->title : '' }}  {{ $course->teacher ? 'استاد '.$course->teacher->full_name : '' }}
		    </td>		
		</tr>
    </table>
</htmlpageheader>

<htmlpagefooter name="myFooter" >
	<p style="text-align: center">صفحه: {PAGENO}</p>
	
</htmlpagefooter>

<table  class="table" >
	<thead>
		<tr>
			<td width="35px" rowspan="2">
				شماره
			</td>
			<td style="width:100px"  colspan="2">
				شهرت
			</td>
			<td colspan="{{ 16}}">
				 تعداد ساعات تدریس
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
			@for($i = 1; $i <= 16 ; $i++)
				<td style="width:30px;color:#ccc;">
					
				</td> 
			@endfor			
		</tr>
	</thead>
	<tbody>
		@foreach($course->students as $student)
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
				@for($i = 1; $i <= 16; $i++)
					<td>					
					</td>					
				@endfor
				<td>
				</dt>											
			</tr>    
		@endforeach
	</tbody>
</table>