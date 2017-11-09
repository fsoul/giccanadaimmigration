<div id="own-work">
    <p>Укажите свой опыт работы, в хронологическом порядке начиная с последнего места работы.</p>
    <div class="multiplication-container" data-parent="work">
        <section>
            <label for="company-name-0">Наименование компании / нанимателя</label>
            <input type="text" name="company-name[]" id="company-name-0" class="to-change-id" data-role="mixed">
            <span class="error-text to-change-id" id="error-company-name-0"></span>
        </section>
        <section>
            <label for="company-country-0" class="to-change-id">Город, страна</label>
            <input type="text" name="company-country[]" id="company-country-0" class="to-change-id" data-role="text">
            <span class="error-text to-change-id" id="error-company-country-0"></span>
        </section>
        <section>
            <label for="company-position-0">Должность</label>
            <input type="text" name="company-position[]" id="company-position-0" class="to-change-id" data-role="text">
            <span class="error-text to-change-id" id="error-company-position-0"></span>
        </section>
        <section>
            <div class="period-date clearfix to-change-id" id="ass-company-period-0" data-msg="error-ass-company-period-0" data-role="period-date">
                <div>
                    <div class="from-date clearfix">
                        <label>Период работы, c</label>
                        <select title="" class="month to-change-id" name="ass-company-from-m[]" id="ass-company-from-m-0"
                                required data-class="ass-company-period-0" data-role="select">
                            <option value="" disabled selected>Month</option>
                            <?= getMonthOptions(); ?>
                        </select>

                        <select title="" class="year to-change-id" name="ass-company-from-y[]" id="ass-company-from-y-0"
                                required data-class="ass-company-period-0" data-role="select">
                            <option value="" disabled selected>Year</option>
                            <?= getYearOptions(); ?>
                        </select>
                    </div>
                    <div class="to-date clearfix">
                        <label>по</label>
                        <select title="" id="ass-company-to-m-0" name="ass-company-to-m[]" class="month to-change-id"
                                required data-class="ass-company-period-0" data-role="select">
                            <option value="" disabled selected>Month</option>
                            <?= getMonthOptions(); ?>
                        </select>

                        <select title="" id="ass-company-to-y-0" name="ass-company-to-y[]" class="year to-change-id"
                                required data-class="ass-company-period-0" data-type="period-date-select" data-role="select">
                            <option value="" disabled selected>Year</option>
                            <?= getYearOptions(); ?>
                        </select>
                    </div>
                    <span class="error-text to-change-id" id="error-ass-company-period-0"></span>
                </div>
            </div>
        </section>
        <section>
            <label for="company-requirement-0">Должностные обязанности</label>
            <textarea name="company-requirement[]" id="company-requirement-0" class="to-change-id" rows="4"
                      cols="50" data-role="mixed"></textarea>
            <span class="error-text to-change-id" id="error-company-requirement-0"></span>
        </section>
    </div>
    <section>
        <button class="ass-add-button" data-block="own-work"><span>Добавить место работы</span></button>
    </section>
</div>