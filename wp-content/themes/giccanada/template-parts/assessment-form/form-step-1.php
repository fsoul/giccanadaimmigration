<p>Ваше полное имя как в загранпаспорте</p>
<section>
    <label for="last-name">Фамилия</label>
    <input type="text" name="last-name" id="last-name" placeholder="Введите свою фамилию">
    <span class="error-text" id="error-last-name"></span>
</section>
<section>
    <label for="first-name">Имя</label>
    <input type="text" name="first-name" id="first-name" placeholder="Введите свое имя">
    <span class="error-text" id="error-first-name"></span>
</section>
<section>
    <label for="middle-name">Отчество</label>
    <input type="text" name="middle-name" id="middle-name" placeholder="Введите свое отчетство">
    <span class="error-text" id="error-middle-name"></span>
</section>
<section class="combine-date birth-date">
    <label>Дата рождения</label>
    <select title="" name="birth-date-d" class="date" required>
        <option value="" disabled selected>Day</option>
        <?php for($i = 1; $i <= 31; ++$i):?>
            <?php $date = $i < 10 ? '0'.$i : $i;?>
            <option value="<?= $date;?>"><?= $date;?></option>
        <?php endfor;?>
    </select>

    <select title="" name="birth-date-m" class="month" required>
        <option value="" disabled selected>Month</option>
        <?php $months = array('January', 'February', 'March','April',
	        'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');?>
	    <?php for($i = 1; $i <= count($months); ++$i):?>
            <option value="<?= $i;?>"><?= $months[$i - 1];?></option>
	    <?php endfor;?>
    </select>

    <select title="" name="birth-date-y" class="year" required>
        <option value="" disabled selected>Year</option>
	    <?php for($i = date('Y'); $i >= 1930; --$i):?>
            <option value="<?= $i;?>"><?= $i;?></option>
	    <?php endfor;?>
    </select>
</section>
<span class="error-text" id="error-birth-date"></span>
<section class="radio-block">
    <label>Пол</label>
    <section>
        <input name="ass-sex" class="ass-radio" value="m" checked type="radio" id="ass-sex-m">
        <label for="ass-sex-m">Мужской</label>
    </section>
    <section>
        <input name="ass-sex" class="ass-radio" value="f" type="radio" id="ass-sex-f">
        <label for="ass-sex-f">Женский</label>
    </section>
</section>

