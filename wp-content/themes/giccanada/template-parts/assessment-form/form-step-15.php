<p>Пожалуйста, предоставьте подробную информацию о членах вашей семьи.
    Вы должны сначала включить супруга/у или гражданского партнера, если имеется, и всех ваших детей на вашем
    иждивении.</p>
<div class="multiplication-container" data-parent="family-members">
    <section>
        <label for="member-last-name-0" class="to-change-id">Фамилия</label>
        <input type="text" name="member-last-name-0" id="member-last-name-0" class="to-change-id"
               placeholder="Введите фамилию">
        <span class="error-text to-change-id" id="error-member-last-name-0"></span>
    </section>
    <section>
        <label for="member-first-name-0" class="to-change-id">Имя</label>
        <input type="text" name="member-first-name-0" id="member-first-name-0" class="to-change-id"
               placeholder="Введите имя">
        <span class="error-text to-change-id" id="error-member-first-name-0"></span>
    </section>
    <section>
        <label for="member-middle-name-0" class="to-change-id">Отчество</label>
        <input type="text" name="member-middle-name-0" id="member-middle-name-0" class="to-change-id"
               placeholder="Введите отчетство">
        <span class="error-text to-change-id" id="error-member-middle-name-0"></span>
    </section>
    <section class="combine-date birth-date">
        <label>Дата рождения</label>
        <div>
            <select title="" name="member-birth-day-0" class="day to-change-id" id="member-birth-day-0" required
                    data-class="member-birth-date-0">
                <option value="" disabled selected>Day</option>
				<?= getDayOptions(); ?>
            </select>

            <select title="" name="member-birth-month-0" class="month to-change-id" id="member-birth-month-0" required
                    data-class="member-birth-date-0">
                <option value="" disabled selected>Month</option>
				<?= getMonthOptions(); ?>
            </select>

            <select title="" name="member-birth-year-0" class="year to-change-id" id="member-birth-year-0" required
                    data-class="member-birth-date-0" data-type="combine-date-select">
                <option value="" disabled selected>Year</option>
				<?= getYearOptions(); ?>
            </select>
        </div>
        <span class="error-text to-change-id" id="error-member-birth-date-0"></span>
    </section>
    <section class="radio-block">
        <label>Пол</label>
        <section>
            <input name="member-sex-0" class="ass-radio to-change-id" value="m" checked type="radio"
                   id="member-sex-m-0">
            <label for="member-sex-m-0" class="to-change-id">Мужской</label>
        </section>
        <section>
            <input name="member-sex-0" class="ass-radio to-change-id" value="f" type="radio" id="member-sex-f-0">
            <label for="member-sex-f-0" class="to-change-id">Женский</label>
        </section>
    </section>
    <section>
        <label for="member-status-0" class="to-change-id">Родственная связь</label>
        <select id="member-status-0" name="member-status-0" class="to-change-id">
            <option value="wife" selected>Супруга</option>
            <option value="husband">Супруг</option>
            <option value="father">Отец</option>
            <option value="mother">Мать</option>
            <option value="brother">Брат</option>
            <option value="sister">Сестра</option>
        </select>
    </section>
    <section class="radio-block">
        <label>Тип отношений</label>
        <section>
            <input name="member-relation-type-0" class="ass-radio to-change-id" value="m" checked type="radio"
                   id="member-relation-type-m-0">
            <label for="member-relation-type-m-0" class="to-change-id">Зарегистрированный брак</label>
        </section>
        <section>
            <input name="member-relation-type-0" class="ass-radio to-change-id" value="cm" type="radio"
                   id="member-relation-type-cm-0">
            <label for="member-relation-type-cm-0" class="to-change-id">Гражданский брак</label>
        </section>
    </section>
    <section>
        <section class="period-date clearfix to-change-id" id="member-relation-period-0">
            <div>
                <div class="from-date clearfix">
                    <label>Отношения, с</label>
                    <select title="" class="month to-change-id" name="member-relation-from-m-0"
                            id="member-relation-from-m-0" required data-class="member-relation-period-0">
                        <option value="" disabled selected>Month</option>
                        <?= getMonthOptions(); ?>
                    </select>

                    <select title="" class="year to-change-id" name="member-relation-from-y-0" id="member-relation-from-y-0"
                            required data-class="member-relation-period-0">
                        <option value="" disabled selected>Year</option>
                        <?= getYearOptions(); ?>
                    </select>
                </div>
                <div class="to-date clearfix">
                    <label>по</label>
                    <select title="" id="member-relation-to-m-0" name="member-relation-to-m-0" class="month to-change-id"
                            required data-class="member-relation-period-0">
                        <option value="" disabled selected>Month</option>
                        <?= getMonthOptions(); ?>
                    </select>

                    <select title="" id="member-relation-to-y-0" name="member-relation-to-y-0" class="year to-change-id"
                            required data-type="period-date-select" data-class="member-relation-period-0">
                        <option value="" disabled selected>Year</option>
                        <?= getYearOptions(); ?>
                    </select>
                </div>
            </div>
            <span class="error-text to-change-id" id="error-member-relation-period-0"></span>
        </section>
    </section>
</div>
<section>
    <button class="ass-add-button">
        <span>Добавить члена семьи</span></button>
</section>