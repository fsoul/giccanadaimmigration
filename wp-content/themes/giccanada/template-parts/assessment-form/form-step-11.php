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
        <select id="education-level-0" name="education-level-0" class="to-change-id" required>
            <option value="" disabled selected>- Выбрать -</option>
            <option value="preschool">Preschool</option>
            <option value="primary">Primary</option>
            <option value="secondary">Secondary</option>
            <option value="higher">Tertiary (higher)</option>
            <option value="vocational">Vocational</option>
            <option value="special">Special</option>
        </select>
    </section>
    <section>
        <label for="education-certificate-type-0" class="to-change-id">Тип свидетельства об образовании (диплом, сертификат, свидетельство)</label>
        <select id="education-certificate-type-0" name="education-certificate-type-0" class="to-change-id" required>
            <option value="" disabled selected>- Выбрать -</option>
            <option value="diploma">Diploma</option>
            <option value="certificate">Certificate</option>
            <option value="testimonial">Testimonial</option>
        </select>
    </section>
    <section>
        <label for="education-type-0" class="to-change-id">Форма обучения</label>
        <select id="education-type-0" name="education-type-0" class="to-change-id">
            <option value="fulltime" selected>Full-time education</option>
            <option value="distance">Distance education </option>
        </select>
    </section>
    <section>
        <section class="period-date clearfix">
            <div class="from-date clearfix">
                <label>Период обучения, c</label>
                <select title="" class="month to-change-id" name="ass-study-from-m-0" id="ass-study-from-m-0" required>
                    <option value="" disabled selected>Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>

                <select title="" class="year to-change-id" name="ass-study-from-y-0" id="ass-study-from-y-0" required>
                    <option value="" disabled selected>Year</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                </select>
            </div>
            <div class="to-date clearfix">
                <label >по</label>
                <select title="" id="ass-study-to-m-0" name="ass-study-to-m-0" class="month to-change-id" required>
                    <option value="" disabled selected>Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>

                <select title="" id="ass-study-to-y-0" name="ass-study-to-y-0" class="year to-change-id" required>
                    <option value="" disabled selected>Year</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                </select>
            </div>
        </section>
    </section>
</div>
<section>
    <button class="ass-add-button" onclick="app.func.copyMultiplicationContainer(event);"><span>Добавить учебное заведение</span></button>
</section>