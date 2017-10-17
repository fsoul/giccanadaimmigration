<p>Укажите свой опыт работы, в хронологическом порядке начиная с последнего места работы.</p>
<div class="multiplication-container">
    <section>
        <label for="company-name-0">Наименование компании / нанимателя</label>
        <input type="text" name="company-name-0" id="company-name-0" class="to-change-id">
    </section>
    <section>
        <label for="company-country-0" class="to-change-id">Город, страна</label>
        <input type="text" name="company-country-0" id="company-country-0" class="to-change-id">
    </section>
    <section>
        <label for="company-position-0">Должность</label>
        <input type="text" name="company-position-0" id="company-position-0" class="to-change-id">
    </section>
    <section>
        <section class="period-date clearfix">
            <div class="from-date clearfix">
                <label>Период работы, c</label>
                <select title="" class="month to-change-id" name="ass-company-from-m-0" id="ass-company-from-m-0" required>
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

                <select title="" class="year to-change-id" name="ass-company-from-y-0" id="ass-company-from-y-0" required>
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
                <select title="" id="ass-company-to-m-0" name="ass-company-to-m-0" class="month to-change-id" required>
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

                <select title="" id="ass-company-to-y-0" name="ass-company-to-y-0" class="year to-change-id" required>
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
    <section>
        <label for="company-requirement-0">Должностные обязанности</label>
        <textarea name="company-requirement-0" id="company-requirement-0" class="to-change-id" rows="4"  cols="50"></textarea>
    </section>
</div>
<section>
    <button class="ass-add-button" onclick="app.func.copyMultiplicationContainer(event);"><span>Добавить место работы</span></button>
</section>