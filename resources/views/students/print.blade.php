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
</style>
</head>
<body>
	@php
		$tazkira = explode('!@#', $student->tazkira);		
	@endphp
	<div class="page">
		<table class="header_table"  style="width:100%;">
			<tr>
				<td  style="text-align:right;width:33%;vertical-align:top;">
					<br>
					<br>
					<p>پوهنحی: <span style="font-size: 12px">{{ $student->department->name }}</span></p>					
					
					<br>
					<p>
					ID محصل: <span style="font-size: 12px">{{ $student->form_no }}</span>
					</p>										
					<br>
					د مکتوب ګڼه او نیټه
					<br>نمبر و تاریخ مکتوب
					<div style="border: 1px solid #aaa;
							width: 124px;
							height: 30px;
							float: left;
							margin-left: 10px;
							margin-top: -8px;">
					</div>
				</td>		
				<td style="text-align:center;width:33%;vertical-align:top;">
					<img src="{{ asset('img/wezarat-logo.jpg') }}"  style="max-width: 80px"/>
					<p style="margin-top:5px;font-size: 14px">د لوړو زده کړو وزارت</p>				
					<p style="margin-top:5px;">پوهنتون {{ $student->university->name }}</p>
					<p style="margin-top:5px;">فورمه سوانح محصل</p>				
				</td>	
				<td style="text-align:right;width:33%;padding-right:17%;vertical-align:top;padding-top:1%;" >					
					<img src="{{ file_exists($student->photo_url) ? asset($student->photo_url) : asset('img/avatar-placeholder.png') }}" style="max-width: 100px">
				</td>				
			</tr>
		</table>	
		<table class="table" style="margin-top: 20px">
			<tr>
				<th class="bg-grey center">
					د محصل پیژند او نښی / شهرت و مشخصات محصل
				</th>
			</tr>
			<tr>
				<td style="padding: 0">
					<table class="table inner-table">
						<tr>
							<th class="bg-grey" colspan="2">پیژند / شهرت</th>
							<th class="bg-grey" colspan="2">د تذکره معلومات / معلومات تذکره</th>
							<th class="bg-grey" colspan="2">د زده کړی معلومات / معلومات تحصیلات</th>
						</tr>
						<tr>
							<td class="bg-grey">نوم / نام</td>
							<td>{{ $student->name }}</td>

							<td class="bg-grey">عمومی کڼه / نمبر عمومی</td>
							<td>{{ $tazkira[3] ?? '' }}</td>

							<td class="bg-grey">د ښوونڅی نوم / نام مکتب</td>
							<td>{{ $student->school_name }}</td>
						</tr>
						<tr>
							<td class="bg-grey"> پلار نوم / نام پدر</td>
							<td>{{ $student->father_name }}</td>

							<td class="bg-grey">ټوک / جلد</td>
							<td>{{ $tazkira[2] ?? '' }}</td>

							<td class="bg-grey"> د فراغت کال / سال فراغت</td>
							<td>{{ $student->school_graduation_year }}</td>
						</tr>
						<tr>
							<td class="bg-grey"> نیکه نوم /  نام پدر کلان</td>
							<td>{{ $student->grandfather_name }}</td>

							<td class="bg-grey">پاڼه/ صفحه</td>
							<td>{{ $tazkira[1] ?? '' }}</td>

							<td class="bg-grey">د کانکور کال / سال کانکور</td>
							<td>{{ $student->kankor_year }}</td>
						</tr>
						<tr>
							<td class="bg-grey"> کورنی نوم /  نام فامیلی</td>
							<td>{{ $student->last_name }}</td>

							<td class="bg-grey"> ثبت ګڼه / شماره ثبت</td>
							<td>{{ $tazkira[0] ?? '' }}</td>

							<td class="bg-grey">کانکور نمره / نمره کانکور</td>
							<td>{{ $student->kankor_score }}</td>
						</tr>
						<tr>
							<td class="bg-grey">ملیت</td>
							<td>{{ $student->nationality }}</td>

							<td class="bg-grey">د زیږیدولو کال / سال تولد</td>
							<td>{{ $student->birthdate }}</td>

							<td class="bg-grey">د کانکور آی ډی / آی دی کانکور</td>
							<td>{{ $student->form_no }}</td>
						</tr>
						<tr>
							<td class="bg-grey">مورنی ژبه / زبان مادری</td>
							<td>{{ $student->language }}</td>

							<td class="bg-grey">مدنی حالت / حالت مدنی</td>
							<td>{{ $student->marital_status =! '' ? trans('general.'.$student->marital_status) : '' }}</td>

							<td class="bg-grey">د اړیکی شمیره / شماره تماس</td>
							<td>{{ $student->phone }}</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<th class="bg-grey center">
					د محصل استوګنه / سکونت محصل
				</th>
			</tr>
			<tr>
				<td style="padding: 0">
					<table class="table inner-table">
						<tr>
							<th class="bg-grey">استوګنه / سکونت</th>
							<th class="bg-grey">ولایت</th>
							<th class="bg-grey">ولسوالی</th>
							<th class="bg-grey">کلی / قریه, ناحیه</th>
							<th class="bg-grey">د کور او کوڅه شمیره / نمبر خانه و کوچه</th>
						</tr>						
						<tr>
							<th class="bg-grey">اصلی</th>
							<td>{{ $student->province }}</td>
							<td>{{ $student->district }}</td>
							<td>{{ $student->village }}</td>							
							<td>{{ $student->address }}</td>
						</tr>						
						<tr>
							<th class="bg-grey">فعلی</th>
							<td>{{ $student->currentProvince ? $student->currentProvince->name : '' }}</td>
							<td>{{ $student->district_current }}</td>
							<td>{{ $student->village_current }}</td>
							<td>{{ $student->address_current }}</td>
							
						</tr>						
					</table>
				</td>
			</tr>
			<tr>
				<th class="bg-grey center">
				د محصل خپلوان او د هغوی دندی / اقارب محصل و وظایف آنها	
				</th>
			</tr>
			<tr>
				<td style="padding: 0">
					<table class="table inner-table">
						<tr>
							<th class="bg-grey">خپلوان / اقارب</th>
							<th class="bg-grey">پیژند / شهرت</th>
							<th class="bg-grey">دنده او د دندی ځای / وظیفه و محل  آن</th>
							<th class="bg-grey">د اړیکو شمیره / شماره تماس</th>							
						</tr>						
						@foreach ($student->relatives as $relative)
						<tr>
							<th class="bg-grey">{{ $relative->relation }}</th>
							<td>{{ $relative->name }}</td>
							<td>{{ $relative->job }}</td>
							<td>{{ $relative->phone }}</td>
							
						</tr>
						@endforeach
					</table>
				</td>
			</tr>					
		</table>	
		<p style="margin-top: 20px">زه / من ({{ $student->name }}) ولد/بنت ({{ $student->father_name }}) </p>
		<p>پورتنی په فورم کی درج شوی معلومات زما د نښو او تذکری مطابق دی او د مغایرت په صورت کی مسولیت زما پر خپله غاړه ده</p>
		<p>معلومات مندرج فورم فوق مطابق مشخصات و تذکره ام بوده و در صورت مغایرت مسولیت بعدی بدوش بنده میباشد</p>
		<p style="float: right; margin-right: 50px;margin-top: 30px">د محصل امضا او شصت / امضا و شصت محصل</p>
		<p style="float: left; margin-left: 50px;margin-top: 30px">د محصلان د آمر امضا / امضا امر محصلان</p>
    </div>		
	<script>
		window.print();
	</script>
</body>
</html>
	