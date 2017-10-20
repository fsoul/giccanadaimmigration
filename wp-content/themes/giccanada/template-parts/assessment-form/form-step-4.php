<section>
    <label for="citizenship">Гражданство</label>
    <input type="text" name="citizenship" id="citizenship">
    <span class="error-text" id="error-citizenship"></span>
</section>
<section class="ass-country">
    <section>
        <label for="country-residence">Страна проживания</label>
        <select id="country-residence" name="country-residence">
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
            <option value="US" selected>Ukraine</option>
            <option value="TD">Chad</option>
            <option value="LK">Sri Lanka</option>
            <option value="ER">Eritrea</option>
            <option value="EE">Estonia</option>
            <option value="ET">Ethiopia</option>
            <option value="SS">South Sudan</option>
            <option value="JM">Jamaica</option>
        </select>
        <span class="error-text" id="error-country-residence"></span>
    </section>
    <section>
        <label for="country-residence-from">C (Г/М)</label>
        <select id="country-residence-from" name="country-residence-from" class="year" required>
            <option value="" disabled selected>Year</option>
	        <?= getYearOptions();?>
        </select>
        <span class="error-text" id="error-country-residence-from"></span>
    </section>
</section>
<section>
    <label>Статус в стране проживания</label>
    <select title="" id="status-residence" name="status-residence">
        <option value="resident" selected>Резидент</option>
    </select>
    <span class="error-text" id="error-status-residence"></span>
</section>
<section>
    <label for="native-lang">Родной язык</label>
    <input type="text" name="native-lang" id="native-lang">
    <span class="error-text" id="error-native-lang"></span>
</section>
