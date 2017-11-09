<div id="own-education">
    <p>Напишите подробно обо всех, полученных вами образованиях (школа, училище, институт, курсы) в хронологическом
        порядке.</p>
    <div class="multiplication-container" data-parent="education">
        <section>
            <label for="education-name-0">Наименование учебного заведения</label>
            <input type="text" name="education-name[]" id="education-name-0" class="to-change-id" data-role="text">
            <span class="error-text to-change-id" id="error-education-name-0"></span>
        </section>
        <section>
            <label for="education-specialty-0" class="to-change-id">Факультет, специальность</label>
            <input type="text" name="education-specialty[]" id="education-specialty-0" class="to-change-id"
                   data-role="text">
            <span class="error-text to-change-id" id="error-education-specialty-0"></span>
        </section>
        <section>
            <label for="education-country-0">Город, страна</label>
            <input type="text" name="education-country[]" id="education-country-0" class="to-change-id"
                   data-role="text">
            <span class="error-text to-change-id" id="error-education-country-0"></span>
        </section>
        <section>
            <label for="education-level-0" class="to-change-id">Уровень образования</label>
            <select id="education-level-0" name="education-level[]" class="to-change-id" required data-role="select">
                <option value="" disabled selected>- Выбрать -</option>
                <option value="preschool">Preschool</option>
                <option value="primary">Primary</option>
                <option value="secondary">Secondary</option>
                <option value="higher">Tertiary (higher)</option>
                <option value="vocational">Vocational</option>
                <option value="special">Special</option>
            </select>
            <span class="error-text to-change-id" id="error-education-level-0"></span>
        </section>
        <section>
            <label for="education-certificate-type-0" class="to-change-id">Тип свидетельства об образовании (диплом,
                сертификат, свидетельство)</label>
            <select id="education-certificate-type-0" name="education-certificate-type[]" class="to-change-id" required
                    data-role="select">
                <option value="" disabled selected>- Выбрать -</option>
                <option value="diploma">Diploma</option>
                <option value="certificate">Certificate</option>
                <option value="testimonial">Testimonial</option>
            </select>
            <span class="error-text to-change-id" id="error-education-certificate-type-0"></span>
        </section>
        <section>
            <label for="education-type-0" class="to-change-id">Форма обучения</label>
            <select id="education-type-0" name="education-type[]" class="to-change-id">
                <option value="fulltime" selected>Full-time education</option>
                <option value="distance">Distance education</option>
            </select>
            <span class="error-text to-change-id" id="error-education-type-0"></span>
        </section>
        <section>
            <div class="period-date clearfix to-change-id" id="ass-study-period-0" data-msg="error-ass-study-period-0" data-role="period-date">
                <div>
                    <div class="from-date clearfix">
                        <label>Период обучения, c</label>
                        <select title="" class="month to-change-id" name="ass-study-from-m[]" id="ass-study-from-m-0"
                                required data-class="ass-study-period-0" data-role="select">
                            <option value="" disabled selected>Month</option>
							<?= getMonthOptions(); ?>
                        </select>

                        <select title="" class="year to-change-id" name="ass-study-from-y[]" id="ass-study-from-y-0"
                                required data-class="ass-study-period-0" data-role="select">
                            <option value="" disabled selected>Year</option>
							<?= getYearOptions(); ?>
                        </select>
                    </div>
                    <div class="to-date clearfix">
                        <label>по</label>
                        <select title="" id="ass-study-to-m-0" name="ass-study-to-m[]" class="month to-change-id"
                                required
                                data-class="ass-study-period-0" data-role="select">
                            <option value="" disabled selected>Month</option>
							<?= getMonthOptions(); ?>
                        </select>

                        <select title="" id="ass-study-to-y-0" name="ass-study-to-y[]" class="year to-change-id"
                                required data-class="ass-study-period-0" data-role="select">
                            <option value="" disabled selected>Year</option>
							<?= getYearOptions(); ?>
                        </select>
                    </div>
                </div>
                <span class="error-text to-change-id" id="error-ass-study-period-0"></span>
            </div>
        </section>
    </div>
    <section>
        <button class="ass-add-button" data-block="own-education"><span>Добавить учебное заведение</span></button>
    </section>
</div>