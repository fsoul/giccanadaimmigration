<p>Ваше полное имя как в загранпаспорте</p>
<section>
    <label for="last-name">Фамилия</label>
    <input type="text" name="last-name" id="last-name" placeholder="Введите свою фамилию" data-role="text">
    <span class="error-text" id="error-last-name"></span>
</section>
<section>
    <label for="first-name">Имя</label>
    <input type="text" name="first-name" id="first-name" placeholder="Введите свое имя" data-role="text">
    <span class="error-text" id="error-first-name"></span>
</section>
<section>
    <label for="middle-name">Отчество</label>
    <input type="text" name="middle-name" id="middle-name" placeholder="Введите свое отчетство" data-role="text">
    <span class="error-text" id="error-middle-name"></span>
</section>
<section class="combine-date birth-date">
    <div data-role="combine-date" data-msg="error-birth-date" id="combine-date-birth-date">
        <label>Дата рождения</label>
        <div>
            <select title="" name="birth-date-d" class="day" required data-class="birth-date" id="birth-date-d">
                <option value="" disabled selected>Day</option>
			    <?= getDayOptions();?>
            </select>

            <select title="" name="birth-date-m" class="month" required data-class="birth-date" id="birth-date-m">
                <option value="" disabled selected>Month</option>
			    <?= getMonthOptions();?>
            </select>

            <select title="" name="birth-date-y" class="year" required data-class="birth-date" id="birth-date-y">
                <option value="" disabled selected>Year</option>
			    <?= getYearOptions();?>
            </select>
        </div>
        <span class="error-text" id="error-birth-date"></span>
    </div>
</section>
<section class="radio-block">
    <label>Пол</label>
    <section>
        <input name="ass-sex" class="ass-radio" value="m" checked type="radio" id="ass-sex-m" data-role="radio">
        <label for="ass-sex-m">Мужской</label>
    </section>
    <section>
        <input name="ass-sex" class="ass-radio" value="f" type="radio" id="ass-sex-f" data-role="radio">
        <label for="ass-sex-f">Женский</label>
    </section>
</section>

