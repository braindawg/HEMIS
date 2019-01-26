
	<style>	
	hr {
		margin-top: -10px;
	}
	h4 {
		margin:0;
		padding:0;
	}
	p {
		margin-top:5px;
	}
	@page {
	  	size: auto;
	  	margin:1cm  3cm  2cm 2.3cm;
	  	margin-header: 5mm; 
	  	margin-footer: 3cm;
		/* header: html_header; */
	  	footer: html_myFooter;
  		/* background-image-resize: 4;       */
	}
</style>
<htmlpagefooter name="myFooter" >
	<table style="width:100%">
		<tr>			
			<td style="text-align:left;">
				<div style="float:left">
					<barcode code="{{$student->form_no}}" size="0.75" type="QR" error="M" class="barcode" style="margin-left:-2px;margin-top:-10px" />
				</div>
			</td>
		</tr>
	</table>	
</htmlpagefooter>
<div style="position: fixed; top: 29px; left: -60px"><small>{{ \App\Models\Number::getNextDocumentNumber($student, 'student') }}</small></div>
<div style="position: fixed; top: 49px; left: -70px"><small>{{ jalaliDate('Y/m/d') }}</small></div>
<div style="position: fixed; top: 100px">
	<table class="header_table"  style="width:100%;">
			<tr>
				<td  style="text-align:right;width:33%;vertical-align:top;">
					
				</td>		
				<td style="text-align:center;width:33%;vertical-align:middle;">				
					
					<p><strong>گواهی تحصیلی </strong></p>
				</td>	
				<td style="text-align:right;width:33%;padding-right:17%;vertical-align:middle;padding-top:1%;" >				
					<!-- <img src = "{{ asset($student->photo()) }}" style ="" > -->
				</td>
			</tr>
	</table>
	<p style="text-align: justify">	 	
	بدینوسیله گواهی می شود اینکه محترم {{ $student->name }} فرزند {{ $student->father_name }} دارای کد دانشجویی {{ $student->form_no }} محصل سمستر 5  دوره {{ $student->university->name }}  رشته {{ $student->department->name }} این دانشگاه بوده و در سمستر جاری مشغول تحصیل می باشد.
</p>
	<br>
	<h3 style="text-align:center">مصطفی نوری <br/>آمر امور محصلان</h3>
</div>