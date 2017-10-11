<p>Напишите подробно обо всех, полученных вами образованиях (школа, училище, институт, курсы) в хронологическом порядке.</p>

<div class="multiplication-container">
    <section>
        <label for="education-name-0">Наименование учебного заведения</label>
        <input type="text" name="education-name" id="education-name-0">
    </section>
    <section>
        <label for="education-specialty-0">Факультет, специальность</label>
        <input type="text" name="education-specialty" id="education-specialty-0">
    </section>
    <section>
        <label for="education-country-0">Город, страна</label>
        <input type="text" name="education-country" id="education-country-0">
    </section>
    <section>
        <label for="education-level-0">Уровень образования</label>
        <select id="education-level-0">
            <option value="" disabled selected>- Выбрать -</option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
        </select>
    </section>
    <section>
        <label for="education-certificate-type-0">Тип свидетельства об образовании (диплом, сертификат, свидетельство)</label>
        <select id="education-certificate-type-0">
            <option value="" disabled selected>- Выбрать -</option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
        </select>
    </section>
    <section>
        <label for="education-type-0">Тип обучения</label>
        <select id="education-type-0">
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
                <select title="" class="month" id="ass-study-from-m-0">
                    <option value="" disabled selected>Месяц</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>

                <select title="" class="year" id="ass-study-from-y-0">
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
                <select title="" id="ass-study-to-m-0" class="month">
                    <option value="" disabled selected>Месяц</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>

                <select title="" id="ass-study-to-y-0" class="year">
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