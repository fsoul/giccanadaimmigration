<div>
    <p>Пожалуйста, предоставьте подробную информацию о Вашем партнере.</p>
    <div>
        <section class="radio-block">
            <label>Есть ли у вас супруг/а или гражданский партнер?</label>
            <section>
                <input name="part-relation" class="ass-radio" value="y" checked type="radio"
                       id="part-relation-y">
                <label for="part-relation-y" >Да</label>
            </section>
            <section>
                <input name="part-relation" class="ass-radio" value="n" type="radio" id="part-relation-n">
                <label for="part-relation-n" >Нет</label>
            </section>
        </section>
        <section>
            <label for="member-last-name" >Фамилия</label>
            <input type="text" name="member-last-name" id="member-last-name"
                   placeholder="Введите фамилию">
            <span class="error-text" id="error-member-last-name"></span>
        </section>
        <section>
            <label for="member-first-name">Имя</label>
            <input type="text" name="member-first-name" id="member-first-name"
                   placeholder="Введите имя">
            <span class="error-text" id="error-member-first-name"></span>
        </section>
        <section>
            <label for="member-middle-name">Отчество</label>
            <input type="text" name="member-middle-name" id="member-middle-name"
                   placeholder="Введите отчетство">
            <span class="error-text" id="error-member-middle-name"></span>
        </section>
        <section class="combine-date birth-date">
            <label>Дата рождения</label>
            <div>
                <select title="" name="member-birth-day" class="day" id="member-birth-day" required
                        data-class="member-birth-date">
                    <option value="" disabled selected>Day</option>
					<?= getDayOptions(); ?>
                </select>

                <select title="" name="member-birth-month" class="month" id="member-birth-month" required
                        data-class="member-birth-date">
                    <option value="" disabled selected>Month</option>
					<?= getMonthOptions(); ?>
                </select>

                <select title="" name="member-birth-year" class="year" id="member-birth-year" required
                        data-class="member-birth-date" data-role="combine-date">
                    <option value="" disabled selected>Year</option>
					<?= getYearOptions(); ?>
                </select>
            </div>
            <span class="error-text" id="error-member-birth-date"></span>
        </section>
        <section class="radio-block">
            <label>Пол</label>
            <section>
                <input name="member-sex" class="ass-radio" value="m" checked type="radio"
                       id="member-sex-m">
                <label for="member-sex-m" >Мужской</label>
            </section>
            <section>
                <input name="member-sex" class="ass-radio" value="f" type="radio" id="member-sex-f">
                <label for="member-sex-f" >Женский</label>
            </section>
        </section>
        <section>
            <label for="member-status" >Родственная связь</label>
            <select id="member-status" name="member-status" >
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
                <input name="member-relation-type" class="ass-radio" value="m" checked type="radio"
                       id="member-relation-type-m">
                <label for="member-relation-type-m" >Зарегистрированный брак</label>
            </section>
            <section>
                <input name="member-relation-type" class="ass-radio" value="cm" type="radio"
                       id="member-relation-type-cm">
                <label for="member-relation-type-cm" >Гражданский брак</label>
            </section>
        </section>
        <section>
            <section class="period-date clearfix" id="member-relation-period">
                <div>
                    <div class="from-date clearfix">
                        <label>Отношения, с</label>
                        <select title="" class="month" name="member-relation-from-m"
                                id="member-relation-from-m" required data-class="member-relation-period">
                            <option value="" disabled selected>Month</option>
							<?= getMonthOptions(); ?>
                        </select>

                        <select title="" class="year" name="member-relation-from-y" id="member-relation-from-y"
                                required data-class="member-relation-period">
                            <option value="" disabled selected>Year</option>
							<?= getYearOptions(); ?>
                        </select>
                    </div>
                    <div class="to-date clearfix">
                        <label>по</label>
                        <select title="" id="member-relation-to-m" name="member-relation-to-m" class="month"
                                required data-class="member-relation-period">
                            <option value="" disabled selected>Month</option>
							<?= getMonthOptions(); ?>
                        </select>

                        <select title="" id="member-relation-to-y" name="member-relation-to-y" class="year"
                                required data-type="period-date-select" data-class="member-relation-period">
                            <option value="" disabled selected>Year</option>
							<?= getYearOptions(); ?>
                        </select>
                    </div>
                </div>
                <span class="error-text" id="error-member-relation-period"></span>
            </section>
        </section>
    </div>
</div>
<div id="part-educ">
    <p>Образование партнера (школа, училище, институт, курсы) в хронологическом порядке.</p>
    <div class="multiplication-container" data-parent="family-members">
        <section>
            <label for="part-educ-name-0">Наименование учебного заведения</label>
            <input type="text" name="part-educ-name[]" id="part-educ-name-0" class="to-change-id">
            <span class="error-text to-change-id" id="error-part-educ-name-0"></span>
        </section>
        <section>
            <label for="part-educ-specialty-0" class="to-change-id">Факультет, специальность</label>
            <input type="text" name="part-educ-specialty[]" id="part-educ-specialty-0" class="to-change-id">
            <span class="error-text to-change-id" id="error-part-educ-specialty-0"></span>
        </section>
        <section>
            <label for="part-educ-country-0">Город, страна</label>
            <input type="text" name="part-educ-country[]" id="part-educ-country-0" class="to-change-id">
            <span class="error-text to-change-id" id="error-part-educ-country-0"></span>
        </section>
        <section>
            <label for="part-educ-level-0" class="to-change-id">Уровень образования</label>
            <select id="part-educ-level-0" name="part-educ-level[]" class="to-change-id" required>
                <option value="" disabled selected>- Выбрать -</option>
                <option value="preschool">Preschool</option>
                <option value="primary">Primary</option>
                <option value="secondary">Secondary</option>
                <option value="higher">Tertiary (higher)</option>
                <option value="vocational">Vocational</option>
                <option value="special">Special</option>
            </select>
            <span class="error-text to-change-id" id="error-part-educ-level-0"></span>
        </section>
        <section>
            <label for="part-educ-certificate-type-0" class="to-change-id">Тип свидетельства об образовании (диплом,
                сертификат, свидетельство)</label>
            <select id="part-educ-certificate-type-0" name="part-educ-certificate-type[]" class="to-change-id" required>
                <option value="" disabled selected>- Выбрать -</option>
                <option value="diploma">Diploma</option>
                <option value="certificate">Certificate</option>
                <option value="testimonial">Testimonial</option>
            </select>
            <span class="error-text to-change-id" id="error-part-educ-certificate-type-0"></span>
        </section>
        <section>
            <label for="part-educ-type-0" class="to-change-id">Форма обучения</label>
            <select id="part-educ-type-0" name="part-educ-type[]" class="to-change-id">
                <option value="fulltime" selected>Full-time education</option>
                <option value="distance">Distance education</option>
            </select>
            <span class="error-text to-change-id" id="error-part-educ-type-0"></span>
        </section>
        <section>
            <section class="period-date clearfix to-change-id" id="part-educ-period-0">
                <div>
                    <div class="from-date clearfix">
                        <label>Период обучения, c</label>
                        <select title="" class="month to-change-id" name="part-educ-from-m[]" id="part-educ-from-m-0"
                                required data-class="part-educ-period-0">
                            <option value="" disabled selected>Month</option>
							<?= getMonthOptions(); ?>
                        </select>

                        <select title="" class="year to-change-id" name="part-educ-from-y[]" id="part-educ-from-y-0"
                                required data-class="part-educ-period-0">
                            <option value="" disabled selected>Year</option>
							<?= getYearOptions(); ?>
                        </select>
                    </div>
                    <div class="to-date clearfix">
                        <label>по</label>
                        <select title="" id="part-educ-to-m-0" name="part-educ-to-m[]" class="month to-change-id" required
                                data-class="part-educ-period-0">
                            <option value="" disabled selected>Month</option>
							<?= getMonthOptions(); ?>
                        </select>

                        <select title="" id="part-educ-to-y-0" name="part-educ-to-y[]" class="year to-change-id" required
                                data-type="period-date-select" data-class="part-educ-period-0">
                            <option value="" disabled selected>Year</option>
							<?= getYearOptions(); ?>
                        </select>
                    </div>
                </div>
                <span class="error-text to-change-id" id="error-part-educ-period-0"></span>
            </section>
        </section>
    </div>
    <section>
        <button class="ass-add-button" data-block="part-educ"><span>Добавить учебное заведение</span></button>
    </section>
</div>
<div id="part-work">
    <p>Укажите опыт работы партнера в хронологическом порядке начиная с последнего места работы.</p>
    <div class="multiplication-container" data-parent="family-members">
        <section>
            <label for="part-work-name-0">Наименование компании / нанимателя</label>
            <input type="text" name="part-work-name[]" id="part-work-name-0" class="to-change-id">
            <span class="error-text to-change-id" id="error-part-work-name-0"></span>
        </section>
        <section>
            <label for="part-work-country-0" class="to-change-id">Город, страна</label>
            <input type="text" name="part-work-country[]" id="part-work-country-0" class="to-change-id">
            <span class="error-text to-change-id" id="error-part-work-country-0"></span>
        </section>
        <section>
            <label for="part-work-position-0">Должность</label>
            <input type="text" name="part-work-position[]" id="part-work-position-0" class="to-change-id">
            <span class="error-text to-change-id" id="error-part-work-position-0"></span>
        </section>
        <section>
            <section class="period-date clearfix to-change-id" id="ass-part-work-period-0">
                <div>
                    <div class="from-date clearfix">
                        <label>Период работы, c</label>
                        <select title="" class="month to-change-id" name="ass-part-work-from-m[]" id="ass-part-work-from-m-0"
                                required data-class="ass-part-work-period-0">
                            <option value="" disabled selected>Month</option>
							<?= getMonthOptions(); ?>
                        </select>

                        <select title="" class="year to-change-id" name="ass-part-work-from-y[]" id="ass-part-work-from-y-0"
                                required data-class="ass-part-work-period-0">
                            <option value="" disabled selected>Year</option>
							<?= getYearOptions(); ?>
                        </select>
                    </div>
                    <div class="to-date clearfix">
                        <label>по</label>
                        <select title="" id="ass-part-work-to-m-0" name="ass-part-work-to-m[]" class="month to-change-id"
                                required data-class="ass-part-work-period-0">
                            <option value="" disabled selected>Month</option>
							<?= getMonthOptions(); ?>
                        </select>

                        <select title="" id="ass-part-work-to-y-0" name="ass-part-work-to-y[]" class="year to-change-id"
                                required data-class="ass-part-work-period-0" data-type="period-date-select">
                            <option value="" disabled selected>Year</option>
							<?= getYearOptions(); ?>
                        </select>
                    </div>
                    <span class="error-text to-change-id" id="error-ass-part-work-period-0"></span>
                </div>
            </section>
        </section>
        <section>
            <label for="part-work-requirement-0">Должностные обязанности</label>
            <textarea name="part-work-requirement[]" id="part-work-requirement-0" class="to-change-id" rows="4"
                      cols="50"></textarea>
            <span class="error-text to-change-id" id="error-part-work-requirement-0"></span>
        </section>
    </div>
    <section>
        <button class="ass-add-button" data-block="part-work"><span>Добавить место работы</span></button>
    </section>
</div>