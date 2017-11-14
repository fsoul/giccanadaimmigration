<?php
$lang = 'ru';

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


?>
<html>
<head></head>
<style>
    body{
        font-family: "DejaVu Sans";
    }
</style>
<body>
<div class="pdf-wrap">
    <?
    $i = 0;
    foreach ($sections[$lang] as $key => $section ) {
        echo "<h3>{$section}</h3>";
        foreach ($labels[$lang][$i] as $lkey => $label){
            echo "<p>{$label}: {$values[$i][$lkey]}</p>";
        }
        $i++;
    }
    ?>

    <? if(!empty($_POST['relative'])) : ?>
        <h3>Родственники в Канаде</h3>

    <?
        $relative = $_POST['relative'];
        foreach($relative['asa-rel-last-name'] as $k => $rel) : ?>
        <p>
            Фамилия: <?= $relative['asa-rel-last-name'][$k]; ?>
        </p>
        <p>
            Имя: <?= $relative['ass-rel-first-name'][$k]; ?>
        </p>
        <p>
            Отчество: <?= $relative['ass-rel-middle-name'][$k]; ?>
        </p>
        <p>
            Родственные связи с вами: <?= $relative['ass-rel-with'][$k]; ?>
        </p>
        <p>
            Статус в Канаде: <?= $relative['ass-rel-status'][$k]; ?>
        </p>
        <p>
            Провинция в Канаде: <?= $relative['ass-rel-province'][$k]; ?>
        </p>
    <? endforeach; ?>
    <? endif; ?>
</div>
</body>
</html>