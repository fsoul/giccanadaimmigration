<section>
    <label for="passport-num">Номер паспорта</label>
    <input type="text" name="passport-num" id="passport-num" data-role="mixed" required>
    <span class="error-text" id="error-passport-num"></span>
</section>
<section class="combine-date passport-exp-date">
    <div data-role="combine-date" data-msg="error-passport-exp-date" id="combine-date-passport-exp-date">
        <label>Действителен до</label>
        <div>
            <select title="" name="passport-exp-date-d" class="day" required data-class="passport-exp-date" id="passport-exp-date-d">
                <option value="" disabled selected>Day</option>
                <?= getDayOptions();?>
            </select>

            <select title="" name="passport-exp-date-m" class="month" required data-class="passport-exp-date" id="passport-exp-date-m">
                <option value="" disabled selected>Month</option>
                <?= getMonthOptions();?>
            </select>

            <select title="" name="passport-exp-y" class="year" required data-class="passport-exp-date" id="passport-exp-date-y">
                <option value="" disabled selected>Year</option>
                <?= getExpirationDateYearsOptions();?>
            </select>
        </div>
        <span class="error-text" id="error-passport-exp-date"></span>
    </div>
</section>
<div class="cb-container">
    <input type="checkbox" onchange="app.func.disableCombineDate(event);" id="ass-no-date-exp-cb" value="yes"
           name="ass-no-date-exp-cb" data-role="checkbox" data-combine="combine-date-passport-exp-date"/>
    <label for="ass-no-date-exp-cb">нет срока истечения документа</span></label>
</div>
<section>
    <label for="passport-country">Страна выдачи паспорта</label>
    <select id="passport-country" name="passport-country" data-role="select" required>
        <option value="AO">Angola</option>
        <option value="AF">Afghanistan</option>
        <option value="BJ">Benin</option>
        <option value="BF">Burkina Faso</option>
        <option value="BI">Burundi</option>
        <option value="GM">Gambia</option>
        <option value="GH">Ghana</option>
        <option value="GT">Guatemala</option>
        <option value="GN">Guinea</option>
        <option value="HT">Haiti</option>
        <option value="HN">Honduras</option>
        <option value="CD">Congo, Democratic Republic</option>
        <option value="ZM">Zambia</option>
        <option value="ZW">Zimbabwe</option>
        <option value="ID">Indonesia</option>
        <option value="IQ">Iraq</option>
        <option value="KH">Cambodia</option>
        <option value="CM">Cameroon</option>
        <option value="CI">Cote D'Ivoire</option>
        <option value="CU">Cuba</option>
        <option value="LA">Lao People's Democratic Republic</option>
        <option value="MG">Madagascar</option>
        <option value="MW">Malawi</option>
        <option value="ML">Mali</option>
        <option value="MZ">Mozambique</option>
        <option value="MN">Mongolia</option>
        <option value="NP">Nepal</option>
        <option value="PA">Panama</option>
        <option value="PG">Papua New Guinea</option>
        <option value="CG">Congo</option>
        <option value="SN">Senegal</option>
        <option value="SY">Syrian Arab Republic</option>
        <option value="SO">Somalia</option>
        <option value="SD">Sudan</option>
        <option value="SL">Sierra Leone</option>
        <option value="TZ">Tanzania</option>
        <option value="TG">Togo</option>
        <option value="UG">Uganda</option>
        <option value="UA" selected>Ukraine</option>
        <option value="TD">Chad</option>
        <option value="LK">Sri Lanka</option>
        <option value="ER">Eritrea</option>
        <option value="EE">Estonia</option>
        <option value="ET">Ethiopia</option>
        <option value="SS">South Sudan</option>
        <option value="JM">Jamaica</option>
    </select>
    <span class="error-text" id="error-passport-country"></span>
</section>
