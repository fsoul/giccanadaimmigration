<p>Ваше полное имя как в загранпаспорте</p>
<section>
    <label for="last_name">Фамилия</label>
    <input type="text" name="last_name" id="last_name" placeholder="Введите свою фамилию">
</section>
<section>
    <label for="first_name">Имя</label>
    <input type="text" name="first_name" id="first_name" placeholder="Введите свое имя">
</section>
<section>
    <label for="middle_name">Отчество</label>
    <input type="text" name="middle_name" id="middle_name" placeholder="Введите свое отчетство">
</section>
<section class="combine-date birth-date">
    <label>Дата рождения</label>
    <select title="" name="birth-date-d" class="date" required>
        <option value="" disabled selected>Day</option>
        <option value="01"></option>
        <option value="02"></option>
        <option value="03"></option>
        <option value="04"></option>
        <option value="05"></option>
        <option value="06"></option>
        <option value="07"></option>
        <option value="08"></option>
        <option value="09"></option>
        <option value="10"></option>
        <option value="11"></option>
        <option value="12"></option>
        <option value="13"></option>
        <option value="14"></option>
        <option value="15"></option>
        <option value="16"></option>
        <option value="17"></option>
        <option value="18"></option>
        <option value="19"></option>
        <option value="20"></option>
        <option value="21"></option>
        <option value="22"></option>
        <option value="23"></option>
        <option value="24"></option>
        <option value="25"></option>
        <option value="26"></option>
        <option value="27"></option>
        <option value="28"></option>
        <option value="29"></option>
        <option value="30"></option>
        <option value="31"></option>
    </select>

    <select title="" name="birth-date-m" class="month" required>
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

    <select title="" name="birth-date-y" class="year" required>
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
</section>
<section class="radio-block">
    <label>Пол</label>
    <section>
        <input name="ass-sex" class="ass-radio" value="m" checked type="radio" id="ass-sex-m">
        <label for="ass-sex-m">Мужской</label>
    </section>
    <section>
        <input name="ass-sex" class="ass-radio" value="f" type="radio" id="ass-sex-f">
        <label for="ass-sex-f">Женский</label>
    </section>
</section>
