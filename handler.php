<?php

require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;

$lang = 'ru';

$labels = [
    'ru' => [
        [
            'last-name' => 'Фамилия',
            'first-name' => 'Имя',
            'middle-name' => 'Отчество',
            'birth-date' => 'Дата рождения',
            'ass-sex' => 'Пол'
        ],
        [
            'ass-family' => 'Семейный статус'
        ],
        [
            'citizenship' => 'Гражданство',
            'country-residence' => 'Страна проживания',
            'country-residence-from' => 'C (Г/М)',
            'status-residence' => 'Статус в стране проживания',
            'native-lang' => 'Родной язык'
        ],
        [
            'passport-num' => 'Номер паспорта',
            'passport-exp-date' => 'Действителен до',
            'passport-country' => 'Страна выдачи паспорта'
        ],
        [
            'ass-phone' => 'Телефон (код страны / города / тел.)',
            'ass-email' => 'E-mail'
        ],
        [
            'speaking' => 'Speaking',
            'reading' => 'Reading',
            'writing' => 'Writing',
            'listening' => 'Listening'
        ],
        [
            'speaking' => 'Speaking',
            'reading' => 'Reading',
            'writing' => 'Writing',
            'listening' => 'Listening'
        ],

    ]
];

$sections = [
    'ru' => [
        'personal-info' => 'Личные данные',
        'family' => 'Семейное положение',
        'personal-info2' => 'Личные данные',
        'passport-data' => 'Паспортные данные',
        'contacts-data' => ' Контактные данные',
        'english' => 'Английский язык',
        'french' => 'Французский язык',

    ]
];

/*
 * 'relative' => ' Родственники в Канаде',
        'canada-residence' => 'Где вы намереваетесь жить в Канаде?',
        'education' => 'Образование'
 *
 *
 *
 *
 * [
            'relationship' => 'Родственные связи с вами',
            'rel-status' => 'Статус в Канаде',
            'ass-rel-province' => 'Провинция в Канаде',
        ],
        [
            'ass-rel-city' => 'Город'
        ]





       [
            'relationship' => 'relationship',
            'rel-status' => rel-status,
            'ass-rel-province' => ass-rel-province,
        ],
        [
            'ass-rel-city' => ass-rel-city
        ]



 * */

$recepient = 'bilinskyivitalii@gmail.com';


$additionalSections = [
    'relative',
    'province',
    'education',

];

if(count($_POST)){

    $values = [
        [
            'last-name' => $_POST['last-name'],
            'first-name' => $_POST['first-name'],
            'middle-name' => $_POST['middle-name'],
            'birth-date' => $_POST['birth-date-d'].".".$_POST['birth-date-m'].".".$_POST['birth-date-y'],
            'ass-sex' => $_POST['ass-sex'] == 'm' ? 'Мужской' : 'Женский'
        ],
        [
            'ass-family' => $_POST['ass-family']
        ],
        [
            'citizenship' => $_POST['citizenship'],
            'country-residence' => $_POST['country-residence'],
            'country-residence-from' => $_POST['country-residence-from'],
            'status-residence' => $_POST['status-residence'],
            'native-lang' => $_POST['native-lang']
        ],
        [
            'passport-num' => $_POST['passport-num'],
            'passport-exp-date' => $_POST['passport-exp-date-d'].".".$_POST['passport-exp-date-m'].".".$_POST['passport-exp-y'],
            'passport-country' => $_POST['passport-country']
        ],
        [
            'ass-phone' => $_POST['ass-phone'],
            'ass-email' => $_POST['ass-email']
        ],
        [
            'speaking' => $_POST['en_lang'][0],
            'reading' => $_POST['en_lang'][1],
            'writing' => $_POST['en_lang'][2],
            'listening' => $_POST['en_lang'][3]
        ],
        [
            'speaking' => $_POST['fr_lang'][0],
            'reading' => $_POST['fr_lang'][1],
            'writing' => $_POST['fr_lang'][2],
            'listening' => $_POST['fr_lang'][3]
        ],

    ];
    $html = "<html><head><style>body{font-family: 'dejavu sans';}</style></head><body>";
    $i = 0;
    foreach ($sections[$lang] as $key => $section ) {
        $html .= "<h3>{$section}</h3>";
        foreach ($labels[$lang][$i] as $lkey => $label){
            $html .= "<p>{$label}: {$values[$i][$lkey]}</p>";
        }

        foreach ($additionalSections as $additional){
            if(isset($_POST['']))
        }

        $i++;
    }
    $html .= "</body></html>";


    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);


    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    $output = $dompdf->output();

    $pdfPath = 'wp-content/themes/giccanada/public/pdf/';
//    $files = glob($pdfPath . '*');
//    if(count($files) > 10){
//        foreach($files as $file){
//            unlink($file);
//        }
//    }

    $pdfFileName = uniqid() . '.pdf';

    $res = file_put_contents($pdfPath . $pdfFileName, $output);

    echo json_encode($_POST);

}