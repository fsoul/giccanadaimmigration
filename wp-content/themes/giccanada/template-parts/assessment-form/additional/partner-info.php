<?php ?>
<section>
    <label for="member-last-name" >Фамилия</label>
    <input type="text" name="partner[member-last-name]" id="member-last-name"
           placeholder="Введите фамилию" data-role="text" required>
    <span class="error-text" id="error-member-last-name"></span>
</section>
<section>
    <label for="member-first-name">Имя</label>
    <input type="text" name="partner[member-first-name]" id="member-first-name"
           placeholder="Введите имя" data-role="text" required>
    <span class="error-text" id="error-member-first-name"></span>
</section>
<section class="combine-date birth-date">
    <div data-role="combine-date" data-msg="error-member-birth-date" id="combine-date-member-birth-date">
        <label>Дата рождения</label>
        <div>
            <select title="" name="partner[member-birth-day]" class="day" id="member-birth-day" required
                    data-class="member-birth-date" data-role="select">
                <option value="" disabled selected>Day</option>
				<?= getDayOptions(); ?>
            </select>

            <select title="" name="partner[member-birth-month]" class="month" id="member-birth-month" required
                    data-class="member-birth-date" data-role="select">
                <option value="" disabled selected>Month</option>
				<?= getMonthOptions(); ?>
            </select>

            <select title="" name="partner[member-birth-year]" class="year" id="member-birth-year" required
                    data-class="member-birth-date" data-role="select">
                <option value="" disabled selected>Year</option>
				<?= getYearOptions(); ?>
            </select>
        </div>
    </div>
    <span class="error-text" id="error-member-birth-date"></span>
</section>
<section class="radio-block">
    <label>Пол</label>
    <section>
        <input name="partner[member-sex]" class="ass-radio" value="male" checked type="radio"
               id="member-sex-m" data-role="radio" required>
        <label for="member-sex-m" >Мужской</label>
    </section>
    <section>
        <input name="partner[member-sex]" class="ass-radio" value="female" type="radio" id="member-sex-f" data-role="radio" required>
        <label for="member-sex-f" >Женский</label>
    </section>
</section>
<section>
    <label for="member-status" >Родственная связь</label>
    <select id="member-status" name="partner[member-status]" data-role="select" required>
        <option value="" disabled selected>- Выбрать -</option>
        <option value="wife">Супруга</option>
        <option value="husband">Супруг</option>
    </select>
    <span class="error-text" id="error-member-status"></span>
</section>
<section class="radio-block">
    <label>Тип отношений</label>
    <section>
        <input name="partner[member-relation-type]" class="ass-radio" value="m" checked type="radio"
               id="member-relation-type-m" data-role="radio" required>
        <label for="member-relation-type-m" >Зарегистрированный брак</label>
    </section>
    <section>
        <input name="partner[member-relation-type]" class="ass-radio" value="cm" type="radio"
               id="member-relation-type-cm" data-role="radio" required>
        <label for="member-relation-type-cm" >Гражданский брак</label>
    </section>
</section>
<section>
    <div class="period-date clearfix" id="member-relation-period" data-msg="error-member-relation-period" data-role="period-date">
        <div>
            <div class="from-date clearfix">
                <label>Отношения, с</label>
                <select title="" class="month" name="partner[member-relation-from-m]"
                        id="member-relation-from-m" required data-class="member-relation-period" data-role="select">
                    <option value="" disabled selected>Month</option>
					<?= getMonthOptions(); ?>
                </select>

                <select title="" class="year" name="partner[member-relation-from-y]" id="member-relation-from-y"
                        required data-class="member-relation-period" data-role="select">
                    <option value="" disabled selected>Year</option>
					<?= getYearOptions(); ?>
                </select>
            </div>
            <div class="to-date clearfix">
                <label>по</label>
                <select title="" id="member-relation-to-m" name="partner[member-relation-to-m]" class="month"
                        required data-class="member-relation-period" data-role="select">
                    <option value="" disabled selected>Month</option>
					<?= getMonthOptions(); ?>
                </select>

                <select title="" id="member-relation-to-y" name="partner[member-relation-to-y]" class="year"
                        required data-type="period-date-select" data-class="member-relation-period" data-role="select">
                    <option value="" disabled selected>Year</option>
					<?= getYearOptions(); ?>
                </select>
            </div>
        </div>
        <span class="error-text" id="error-member-relation-period"></span>
    </div>
</section>
