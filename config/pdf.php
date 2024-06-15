<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4-L',
    'schedule-font-size'           => '12px',
    'history-font-size'           => '20px',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => '',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('storage/temp/'),
	'pdf_a'                 => false,
	'pdf_a_auto'            => false,
	'icc_profile_path'      => '',
    'defaultCssFile'        => public_path('css/bootstrap.css'),
    'pdfWrapper'            => 'misterspelik\LaravelPdf\Wrapper\PdfWrapper',
    'font_path' => public_path('Fonts/Shabnam/'),
	'font_data' => [
		'Shabnam' => [
			'R'  => 'Shabnam-FD.ttf',    // regular font
			'B'  => 'Shabnam-Bold-FD.ttf',       // optional: bold font
			// 'I'  => 'Shabnam-FD.ttf',     // optional: italic font
			// 'BI' => 'Shabnam-FD.ttf', // optional: bold-italic font
			'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ],
		// ...add as many as you want.
	],
    'default_font' => 'Shabnam',
];
