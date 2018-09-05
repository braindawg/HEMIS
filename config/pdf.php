<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('storage/temp'),
	'font_path' => base_path('resources/fonts/'),
	'font_data' => [
		'nazanin' => [
			'R'  => 'Nazanin-Regular.ttf',    // regular font
			'B'  => 'Nazanin-Bold.ttf',       // optional: bold font
			//'I'  => 'Nazanin-Italic.ttf',     // optional: italic font
			//'BI' => 'Nazanin-Bold-Italic.ttf' // optional: bold-italic font
			'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
			'unAGlyphs' => true
		],
		'yekan' => [
			'R'  => 'BYekan.ttf',    // regular font
			'B'  => 'BYekan-Bold.ttf',       // optional: bold font
			//'I'  => 'Nazanin-Italic.ttf',     // optional: italic font
			//'BI' => 'Nazanin-Bold-Italic.ttf' // optional: bold-italic font
			'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
			'unAGlyphs' => true
		]
		// ...add as many as you want.
	],
	'default_font' => 'yekan',
	'directionality' => 'rtl',
];
