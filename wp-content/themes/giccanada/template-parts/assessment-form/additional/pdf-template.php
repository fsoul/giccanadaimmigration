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
        <? foreach ($_POST['relative'] as $k => $persons) : ?>

            <p>
                Фамилия: <?= $_POST['relative'][$k]['asa-rel-last-name']; ?>
            </p>
            <p>
                Имя: <?= $_POST['relative'][$k]['ass-rel-first-name']; ?>
            </p>
            <p>
                Отчество: <?= $_POST['relative'][$k]['ass-rel-middle-name']; ?>
            </p>
            <p>
                Родственные связи с вами: <?= $_POST['relative'][$k]['ass-rel-with']; ?>
            </p>
            <p>
                Статус в Канаде: <?= $_POST['relative'][$k]['ass-rel-status']; ?>
            </p>
            <p>
                Провинция в Канаде: <?= $_POST['relative'][$k]['ass-rel-province']; ?>
            </p>

        <? endforeach; ?>
    <? endif; ?>

    <h3>Где вы намереваетесь жить в Канаде?</h3>
    <p>Провинция в Канаде: <?= $_POST['ass-rel-province']; ?></p>
    <p>Город: <?= $_POST['ass-rel-city']; ?></p>

    <? if(!empty($_POST['education'])) : ?>
        <h3>Образование</h3>
        <? foreach ($_POST['education'] as $k => $item) : ?>

            <p>
                Наименование учебного заведения: <?= $_POST['education'][$k]['education-name']; ?>
            </p>
            <p>
                Факультет, специальность: <?= $_POST['education'][$k]['education-specialty']; ?>
            </p>
            <p>
                Город, страна: <?= $_POST['education'][$k]['education-country']; ?>
            </p>
            <p>
                Уровень образования: <?= $_POST['education'][$k]['education-level']; ?>
            </p>
            <p>
                Тип свидетельства об образовании (диплом, сертификат, свидетельство): <?= $_POST['education'][$k]['education-certificate-type']; ?>
            </p>
            <p>
                Форма обучения: <?= $_POST['education'][$k]['education-type']; ?>
            </p>
            <p>
                Период обучения с <?= $_POST['education'][$k]['ass-study-from-m'].'.'.$_POST['education'][$k]['ass-study-from-y']; ?> по <?= $_POST['education'][$k]['ass-study-to-m'].'.'.$_POST['education'][$k]['ass-study-to-y']; ?>
            </p>

        <? endforeach; ?>
    <? endif; ?>

    <? if(!empty($_POST['work'])) : ?>
        <h3>Опыт работы</h3>
        <? foreach ($_POST['work'] as $k => $item) : ?>

            <p>
                Наименование компании / нанимателя: <?= $_POST['work'][$k]['company-name']; ?>
            </p>
            <p>
                Город, страна: <?= $_POST['work'][$k]['company-country']; ?>
            </p>
            <p>
                Должность: <?= $_POST['work'][$k]['company-position']; ?>
            </p>
            <p>
                Период работы с <?= $_POST['work'][$k]['ass-company-from-m'].'.'.$_POST['work'][$k]['ass-company-from-y']; ?> по <?= $_POST['work'][$k]['ass-company-to-m'].'.'.$_POST['work'][$k]['ass-company-to-y']; ?>
            </p>
            <p>
                Должностные обязанности: <?= $_POST['work'][$k]['company-requirement']; ?>
            </p>

        <? endforeach; ?>
    <? endif; ?>


    <? if(!empty($_POST['partner'])) : ?>
        <h3>Информация о партнере</h3>

        <p>
            Фамилия: <?= $_POST['partner']['member-last-name']; ?>
        </p>
        <p>
            Имя: <?= $_POST['partner']['member-first-name']; ?>
        </p>
        <p>
            Отчество: <?= $_POST['partner']['member-middle-name']; ?>
        </p>
        <p>
            Дата рождения: <?= $_POST['partner']['member-birth-day'].'.'.$_POST['partner']['member-birth-month'].'.'.$_POST['partner']['member-birth-year']; ?>
        </p>
        <p>
            Пол: <?= $_POST['partner']['member-sex'] == 'm' ? 'Мужской' : 'Женский'; ?>
        </p>
        <p>
            Родственная связь: <?= $_POST['partner']['member-status'] == 'm' ? 'Зарегистрированный брак' : 'Гражданский брак'; ?>
        </p>
        <p>
            Тип отношений <?= $_POST['partner']['member-relation-type']; ?>
        </p>
        <p>
            Отношения с <?= $_POST['partner']['member-relation-from-m'].'.'.$_POST['partner']['member-relation-from-y']; ?> по <?= $_POST['partner']['member-relation-to-m'].'.'.$_POST['education']['member-relation-to-y']; ?>
        </p>

        <? if(!empty($_POST['part-educ'])) : ?>
            <h3>Образование партнера</h3>
            <? foreach ($_POST['part-educ'] as $k => $item) : ?>

                <p>
                    Наименование учебного заведения: <?= $_POST['part-educ'][$k]['part-educ-name']; ?>
                </p>
                <p>
                    Факультет, специальность: <?= $_POST['part-educ'][$k]['part-educ-specialty']; ?>
                </p>
                <p>
                    Город, страна: <?= $_POST['part-educ'][$k]['part-educ-country']; ?>
                </p>
                <p>
                    Уровень образования: <?= $_POST['part-educ'][$k]['part-educ-level']; ?>
                </p>
                <p>
                    Тип свидетельства об образовании (диплом, сертификат, свидетельство): <?= $_POST['part-educ'][$k]['part-educ-certificate-type']; ?>
                </p>
                <p>
                    Форма обучения: <?= $_POST['part-educ'][$k]['part-educ-type']; ?>
                </p>
                <p>
                    Период обучения с <?= $_POST['part-educ'][$k]['part-educ-from-m'].'.'.$_POST['part-educ'][$k]['part-educ-from-y']; ?> по <?= $_POST['part-educ'][$k]['part-educ-to-m'].'.'.$_POST['part-educ'][$k]['part-educ-to-y']; ?>
                </p>

            <? endforeach; ?>
        <? endif; ?>

        <? if(!empty($_POST['part-work'])) : ?>
            <h3>Опыт работы партнера</h3>
            <? foreach ($_POST['part-work'] as $k => $item) : ?>

                <p>
                    Наименование компании / нанимателя: <?= $_POST['part-work'][$k]['part-work-name']; ?>
                </p>
                <p>
                    Город, страна: <?= $_POST['part-work'][$k]['part-work-country']; ?>
                </p>
                <p>
                    Должность: <?= $_POST['part-work'][$k]['part-work-position']; ?>
                </p>
                <p>
                    Период работы с <?= $_POST['part-work'][$k]['ass-part-work-from-m'].'.'.$_POST['part-work'][$k]['ass-part-work-from-y']; ?> по <?= $_POST['part-work'][$k]['ass-part-work-to-m'].'.'.$_POST['part-work'][$k]['ass-part-work-to-y']; ?>
                </p>
                <p>
                    Должностные обязанности: <?= $_POST['part-work'][$k]['part-work-requirement']; ?>
                </p>

            <? endforeach; ?>
        <? endif; ?>

    <? endif; ?>

    <? if(!empty($_POST['child'])) : ?>
        <h3>Информация о детях</h3>
        <? foreach ($_POST['child'] as $k => $persons) : ?>

            <p>
                Фамилия: <?= $_POST['child'][$k]['child-surname']; ?>
            </p>
            <p>
                Имя: <?= $_POST['child'][$k]['child-name']; ?>
            </p>
            <p>
                Дата рождения: <?= $_POST['child'][$k]['child-birth-day'].'.'.$_POST['child'][$k]['child-birth-month'].'.'.$_POST['child'][$k]['child-birth-year']; ?>
            </p>

        <? endforeach; ?>
    <? endif; ?>

</div>
</body>
</html>