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
    <div>
        <select title="" name="birth-date-d" class="date" required data-class="birth-date">
            <option value="" disabled selected>Day</option>
		    <?= getDateOptions();?>
        </select>

        <select title="" name="birth-date-m" class="month" required data-class="birth-date">
            <option value="" disabled selected>Month</option>
            <?= getMonthOptions();?>
        </select>

        <select title="" name="birth-date-y" class="year" required data-type="combine-date-select" data-class="birth-date">
            <option value="" disabled selected>Year</option>
	        <?= getYearOptions();?>
        </select>
    </div>
    <span class="error-text" id="error-birth-date"></span>
</section>
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

