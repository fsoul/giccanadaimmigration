<p>Напишите подробно обо всех, полученных вами образованиях (школа, училище, институт, курсы) в хронологическом порядке.</p>

<div class="multiplication-container">
    <section>
        <label for="education-name-0">Наименование учебного заведения</label>
        <input type="text" name="education-name-0"" id="education-name-0" class="to-change-id">
    </section>
    <section>
        <label for="education-specialty-0" class="to-change-id">Факультет, специальность</label>
        <input type="text" name="education-specialty-0" id="education-specialty-0" class="to-change-id">
    </section>
    <section>
        <label for="education-country-0">Город, страна</label>
        <input type="text" name="education-country-0" id="education-country-0" class="to-change-id">
    </section>
    <section>
        <label for="education-level-0" class="to-change-id">Уровень образования</label>
        <select id="education-level-0" name="education-level-0" class="to-change-id">
            <option value="" disabled selected>- Выбрать -</option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
        </select>
    </section>
    <section>
        <label for="education-certificate-type-0" class="to-change-id">Тип свидетельства об образовании (диплом, сертификат, свидетельство)</label>
        <select id="education-certificate-type-0" name="education-certificate-type-0" class="to-change-id">
            <option value="" disabled selected>- Выбрать -</option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
        </select>
    </section>
    <section>
        <label for="education-type-0" class="to-change-id">Тип обучения</label>
        <select id="education-type-0" name="education-type-0" class="to-change-id">
            <option value="" selected>Стационар</option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
        </select>
    </section>
    <section>
        <section class="period-date clearfix">
            <div class="from-date clearfix">
                <label>Период обучения, c</label>
                <select title="" class="month to-change-id" name="ass-study-from-m-0" id="ass-study-from-m-0">
                    <option value="" disabled selected>Месяц</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>

                <select title="" class="year to-change-id" name="ass-study-from-y-0" id="ass-study-from-y-0">
                    <option value="" disabled selected>Год</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>
            <div class="to-date clearfix">
                <label >по</label>
                <select title="" id="ass-study-to-m-0" name="ass-study-to-m-0" class="month to-change-id">
                    <option value="" disabled selected>Месяц</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>

                <select title="" id="ass-study-to-y-0" name="ass-study-to-y-0" class="year to-change-id">
                    <option value="" disabled selected>Год</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>
        </section>
    </section>
</div>
<section>
    <button class="ass-add-button" onclick="app.func.copyMultiplicationContainer(event);"><span>Добавить учебное заведение</span></button>
</section>