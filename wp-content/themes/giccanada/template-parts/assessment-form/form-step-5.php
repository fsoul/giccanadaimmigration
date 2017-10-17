<section>
    <label for="passport_num">Номер паспорта</label>
    <input type="text" name="passport_num" id="passport_num">
</section>
<section class="combine-date passport-expiration-date">
    <label>Действителен до</label>
    <select title="" name="passport-expiration-date-d" class="date" required>
        <option value="" disabled selected>Day</option>
	    <?php for($i = 1; $i <= 31; ++$i):?>
		    <?php $date = $i < 10 ? '0'.$i : $i;?>
            <option value="<?= $date;?>"><?= $date;?></option>
	    <?php endfor;?>
    </select>

    <select title="" name="passport-expiration-date-m" class="month" required>
        <option value="" disabled selected>Month</option>
	    <?php $months = array('January', 'February', 'March','April',
		    'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');?>
	    <?php for($i = 1; $i <= count($months); ++$i):?>
            <option value="<?= $i;?>"><?= $months[$i - 1];?></option>
	    <?php endfor;?>
    </select>

    <select title="" name="passport-expiration-y" class="year" required>
        <option value="" disabled selected>Year</option>
	    <?php for($i = date('Y'); $i >= 1930; --$i):?>
            <option value="<?= $i;?>"><?= $i;?></option>
	    <?php endfor;?>
    </select>
</section>
<section>
    <label for="passport_country">Страна выдачи паспорта</label>
    <select id="passport_country" name="passport_country">
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
</section>
