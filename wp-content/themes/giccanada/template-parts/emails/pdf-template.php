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
            'passport-country' => 'Страна выдачи паспорта',
            'ass-no-date-exp-cb' => 'нет срока истечения документа',
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
        'last-name' => $form['last-name'],
        'first-name' => $form['first-name'],
        'birth-date' => $form['birth-date-d'].".".$form['birth-date-m'].".".$form['birth-date-y'],
        'ass-sex' => $form['ass-sex'] == 'm' ? 'Мужской' : 'Женский'
    ],
    [
        'ass-family' => $form['ass-family']
    ],
    [
        'citizenship' => $form['citizenship'],
        'country-residence' => $form['country-residence'],
        'country-residence-from' => $form['country-residence-from'],
        'status-residence' => $form['status-residence'],
        'native-lang' => $form['native-lang']
    ],
    [
        'passport-num' => $form['passport-num'],
        'passport-exp-date' => $form['ass-no-date-exp-cb'] != 'yes' ? $form['passport-exp-d'].".".$form['passport-exp-m'].".".$form['passport-exp-y'] : '',
        'passport-country' => $form['passport-country'],
        'ass-no-date-exp-cb' => $form['ass-no-date-exp-cb']
    ],
    [
        'ass-phone' => $form['ass-phone'],
        'ass-email' => $form['ass-email']
    ],
    [
        'speaking' => $form['en_lang']['speaking'],
        'reading' => $form['en_lang']['reading'],
        'writing' => $form['en_lang']['writing'],
        'listening' => $form['en_lang']['listening']
    ],
	[
		'speaking' => $form['fr_lang']['speaking'],
		'reading' => $form['fr_lang']['reading'],
		'writing' => $form['fr_lang']['writing'],
		'listening' => $form['fr_lang']['listening']
	]
];


?>
<html>
<head></head>
<style>
    body{
        font-family: "DejaVu Sans", sans-serif;
    }
</style>
<body>
<div class="pdf-wrap">
    <?php
    $i = 0;
    foreach ($sections[$lang] as $key => $section ) {
        echo "<h3>{$section}</h3>";
        foreach ($labels[$lang][$i] as $lkey => $label){
            echo "<p>{$label}: {$values[$i][$lkey]}</p>";
        }
        $i++;
    }
    ?>

    <?php if(!empty($form['relative'])) : ?>
        <h3>Родственники в Канаде</h3>
        <?php foreach ($form['relative'] as $k => $persons) : ?>

            <p>
                Фамилия: <?= $form['relative'][$k]['ass-rel-last-name']; ?>
            </p>
            <p>
                Имя: <?= $form['relative'][$k]['ass-rel-first-name']; ?>
            </p>
            <p>
                Родственные связи с вами: <?= $form['relative'][$k]['ass-rel-with']; ?>
            </p>
            <p>
                Статус в Канаде: <?= $form['relative'][$k]['ass-rel-status']; ?>
            </p>
            <p>
                Провинция в Канаде: <?= $form['relative'][$k]['ass-rel-province']; ?>
            </p>

        <?php endforeach; ?>
    <?php endif; ?>

    <h3>Где вы планируете жить в Канаде?</h3>
    <p>Провинция в Канаде: <?= $form['ass-future-province']; ?></p>
    <p>Город: <?= $form['ass-future-city']; ?></p>

    <?php if(!empty($form['education'])) : ?>
        <h3>Образование</h3>
        <?php foreach ($form['education'] as $k => $item) : ?>

            <p>
                Наименование учебного заведения: <?= $form['education'][$k]['education-name']; ?>
            </p>
            <p>
                Факультет, специальность: <?= $form['education'][$k]['education-specialty']; ?>
            </p>
            <p>
                Город, страна: <?= $form['education'][$k]['education-country']; ?>
            </p>
            <p>
                Уровень образования: <?= $form['education'][$k]['education-level']; ?>
            </p>
            <p>
                Тип свидетельства об образовании (диплом, сертификат, свидетельство): <?= $form['education'][$k]['education-certificate-type']; ?>
            </p>
            <p>
                Форма обучения: <?= $form['education'][$k]['education-type']; ?>
            </p>
            <p>
                Период обучения с <?= $form['education'][$k]['ass-study-from-m'].'.'.$form['education'][$k]['ass-study-from-y']; ?> по <?= $form['education'][$k]['ass-study-to-m'].'.'.$form['education'][$k]['ass-study-to-y']; ?>
            </p>

        <?php endforeach; ?>
    <?php endif; ?>

    <?php if(!empty($form['work'])) : ?>
        <h3>Опыт работы</h3>
        <?php foreach ($form['work'] as $k => $item) : ?>

            <p>
                Наименование компании / нанимателя: <?= $form['work'][$k]['company-name']; ?>
            </p>
            <p>
                Город, страна: <?= $form['work'][$k]['company-country']; ?>
            </p>
            <p>
                Должность: <?= $form['work'][$k]['company-position']; ?>
            </p>
            <p>
                Период работы с <?= $form['work'][$k]['ass-company-from-m'].'.'.$form['work'][$k]['ass-company-from-y']; ?> по <?= $form['work'][$k]['ass-company-to-m'].'.'.$form['work'][$k]['ass-company-to-y']; ?>
            </p>
            <p>
                Должностные обязанности: <?= $form['work'][$k]['company-requirement']; ?>
            </p>

        <?php endforeach; ?>
    <?php endif; ?>


    <?php if(!empty($form['partner'])) : ?>
        <h3>Информация о партнере</h3>

        <p>
            Фамилия: <?= $form['partner']['member-last-name']; ?>
        </p>
        <p>
            Имя: <?= $form['partner']['member-first-name']; ?>
        </p>
        <p>
            Дата рождения: <?= $form['partner']['member-birth-day'].'.'.$form['partner']['member-birth-month'].'.'.$form['partner']['member-birth-year']; ?>
        </p>
        <p>
            Пол: <?= $form['partner']['member-sex'] == 'm' ? 'Мужской' : 'Женский'; ?>
        </p>
        <p>
            Родственная связь: <?= $form['partner']['member-status'] == 'm' ? 'Зарегистрированный брак' : 'Гражданский брак'; ?>
        </p>
        <p>
            Тип отношений <?= $form['partner']['member-relation-type']; ?>
        </p>
        <p>
            Отношения с <?= $form['partner']['member-relation-from-m'].'.'.$form['partner']['member-relation-from-y']; ?> по <?= $form['partner']['member-relation-to-m'].'.'.$form['partner']['member-relation-to-y']; ?>
        </p>

        <?php if(!empty($form['part-educ'])) : ?>
            <h3>Образование партнера</h3>
            <?php foreach ($form['part-educ'] as $k => $item) : ?>

                <p>
                    Наименование учебного заведения: <?= $form['part-educ'][$k]['part-educ-name']; ?>
                </p>
                <p>
                    Факультет, специальность: <?= $form['part-educ'][$k]['part-educ-specialty']; ?>
                </p>
                <p>
                    Город, страна: <?= $form['part-educ'][$k]['part-educ-country']; ?>
                </p>
                <p>
                    Уровень образования: <?= $form['part-educ'][$k]['part-educ-level']; ?>
                </p>
                <p>
                    Тип свидетельства об образовании (диплом, сертификат, свидетельство): <?= $form['part-educ'][$k]['part-educ-certificate-type']; ?>
                </p>
                <p>
                    Форма обучения: <?= $form['part-educ'][$k]['part-educ-type']; ?>
                </p>
                <p>
                    Период обучения с <?= $form['part-educ'][$k]['part-educ-from-m'].'.'.$form['part-educ'][$k]['part-educ-from-y']; ?> по <?= $form['part-educ'][$k]['part-educ-to-m'].'.'.$form['part-educ'][$k]['part-educ-to-y']; ?>
                </p>

            <?php endforeach; ?>
        <?php endif; ?>

        <?php if(!empty($form['part-work'])) : ?>
            <h3>Опыт работы партнера</h3>
            <?php foreach ($form['part-work'] as $k => $item) : ?>

                <p>
                    Наименование компании / нанимателя: <?= $form['part-work'][$k]['part-work-name']; ?>
                </p>
                <p>
                    Город, страна: <?= $form['part-work'][$k]['part-work-country']; ?>
                </p>
                <p>
                    Должность: <?= $form['part-work'][$k]['part-work-position']; ?>
                </p>
                <p>
                    Период работы с <?= $form['part-work'][$k]['ass-part-work-from-m'].'.'.$form['part-work'][$k]['ass-part-work-from-y']; ?> по <?= $form['part-work'][$k]['ass-part-work-to-m'].'.'.$form['part-work'][$k]['ass-part-work-to-y']; ?>
                </p>
                <p>
                    Должностные обязанности: <?= $form['part-work'][$k]['part-work-requirement']; ?>
                </p>

            <?php endforeach; ?>
        <?php endif; ?>

    <?php endif; ?>

    <?php if(!empty($form['child'])) : ?>
        <h3>Информация о детях</h3>
        <?php foreach ($form['child'] as $k => $persons) : ?>

            <p>
                Фамилия: <?= $form['child'][$k]['child-surname']; ?>
            </p>
            <p>
                Имя: <?= $form['child'][$k]['child-name']; ?>
            </p>
            <p>
                Дата рождения: <?= $form['child'][$k]['child-birth-day'].'.'.$form['child'][$k]['child-birth-month'].'.'.$form['child'][$k]['child-birth-year']; ?>
            </p>

        <?php endforeach; ?>
    <?php endif; ?>

</div>
</body>
</html>