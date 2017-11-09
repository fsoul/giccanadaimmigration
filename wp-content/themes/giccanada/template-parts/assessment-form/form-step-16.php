<div id="own-children">
    <p>Пожалуйста, предоставьте информацию о всех детях на вашем иждивении.</p>
    <div class="multiplication-container" data-parent="children">
        <section class="radio-block">
            <label>Есть ли у вас дети?</label>
            <section>
                <input name="child-relation" class="ass-radio" value="y" checked type="radio"
                       id="child-relation-y" data-role="radio">
                <label for="child-relation-y" >Да</label>
            </section>
            <section>
                <input name="child-relation" class="ass-radio" value="n" type="radio" id="child-relation-n" data-role="radio">
                <label for="child-relation-n" >Нет</label>
            </section>
        </section>
        <section>
            <label for="child-surname-0">Фамилия</label>
            <input type="text" name="child-surname[]" id="child-surname-0" class="to-change-id" data-role="text">
            <span class="error-text to-change-id" id="error-child-surname-0"></span>
        </section>
        <section>
            <label for="child-name-0" class="to-change-id">Имя</label>
            <input type="text" name="child-name[]" id="child-name-0" class="to-change-id" data-role="text">
            <span class="error-text to-change-id" id="error-child-name-0"></span>
        </section>
        <section class="combine-date birth-date">
            <div class="to-change-id" data-role="combine-date" id="child-birth-date-0" data-msg="error-child-birth-date-0">
                <label>Дата рождения</label>
                <div>
                    <select title="to-change-id" name="child-birth-day[]" class="day to-change-id" id="child-birth-day-0" required
                            data-class="child-birth-date-0" data-role="select">
                        <option value="" disabled selected>Day</option>
			            <?= getDayOptions(); ?>
                    </select>

                    <select title="" name="child-birth-month[]" class="month to-change-id" id="child-birth-month-0" required
                            data-class="child-birth-date-0" data-role="select">
                        <option value="" disabled selected>Month</option>
			            <?= getMonthOptions(); ?>
                    </select>

                    <select title="" name="child-birth-year[]" class="year to-change-id" id="child-birth-year-0" required
                            data-class="child-birth-date-0" data-role="select">
                        <option value="" disabled selected>Year</option>
			            <?= getYearOptions(); ?>
                    </select>
                </div>
                <span class="error-text to-change-id" id="error-child-birth-date-0"></span>
            </div>
        </section>
    </div>
    <section>
        <button class="ass-add-button" data-block="own-children"><span>Добавить ребенка</span></button>
    </section>
</div>