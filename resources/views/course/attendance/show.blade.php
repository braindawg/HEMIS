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
				<h3> وزارت تحصیلات عالی افغانستان</h3>
				{{--<h3>{{ $course->department->name }}</h3>--}}
			</td>
			{{--<td style="text-align:center; width:33%;">--}}
				{{--<img src="{{ $course->university->logo }}" style='max-width: 100px' >--}}
			{{--</td>--}}
		    {{--<td style="vertical-align:bottom; width: 33%">--}}
		    	{{--<span style="color: #fff">.</span>--}}
		    {{--</td>--}}
		</tr>
		{{--<tr>--}}
			{{--<td style="text-align: center; padding-top: 10px" colspan="3" >--}}
		    	{{--جدول حاضری  {{ $course->semester != '' ? 'سمستر '.$course->semester : '' }} {{ $course->year != '' ? 'سال '.$course->year : '' }} {{ $course->subject != '' ? 'مضمون '.$course->subject->title : '' }}  {{ $course->teacher != '' ? 'استاد '.$course->teacher->name : '' }}--}}
		    {{--</td>--}}
		{{--</tr>--}}
    </table>
</htmlpageheader>
<htmlpagefooter name="myFooter" >
	<p style="text-align: center">{PAGENO} صفحه:</p>

</htmlpagefooter>
