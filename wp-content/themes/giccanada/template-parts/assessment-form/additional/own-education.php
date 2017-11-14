<div class="delete-copy"><span class="added-file-delete" data-parent="#own-education" data-del="-copy<?=$index;?>"><i class="fa fa-times"></i></span></div>
<section>
    <label for="education-name-<?=$index;?>">Наименование учебного заведения</label>
    <input type="text" name="education[<?=$index;?>][education-name]" id="education-name-<?=$index;?>" data-role="mixed">
    <span class="error-text" id="error-education-name-<?=$index;?>"></span>
</section>
<section>
    <label for="education-specialty-<?=$index;?>">Факультет, специальность</label>
    <input type="text" name="education[<?=$index;?>][education-specialty]" id="education-specialty-<?=$index;?>"
           data-role="text">
    <span class="error-text" id="error-education-specialty-<?=$index;?>"></span>
</section>
<section>
    <label for="education-country-<?=$index;?>">Город, страна</label>
    <input type="text" name="education[<?=$index;?>][education-country]" id="education-country-<?=$index;?>"
           data-role="text">
    <span class="error-text" id="error-education-country-<?=$index;?>"></span>
</section>
<section>
    <label for="education-level-<?=$index;?>">Уровень образования</label>
    <select id="education-level-<?=$index;?>" name="education[<?=$index;?>][education-level]" required data-role="select">
        <option value="" disabled selected>- Выбрать -</option>
        <option value="preschool">Preschool</option>
        <option value="primary">Primary</option>
        <option value="secondary">Secondary</option>
        <option value="higher">Tertiary (higher)</option>
        <option value="vocational">Vocational</option>
        <option value="special">Special</option>
    </select>
    <span class="error-text" id="error-education-level-<?=$index;?>"></span>
</section>
<section>
    <label for="education-certificate-type-<?=$index;?>">Тип свидетельства об образовании (диплом,
        сертификат, свидетельство)</label>
    <select id="education-certificate-type-<?=$index;?>" name="education[<?=$index;?>][education-certificate-type]" required
            data-role="select">
        <option value="" disabled selected>- Выбрать -</option>
        <option value="diploma">Diploma</option>
        <option value="certificate">Certificate</option>
        <option value="testimonial">Testimonial</option>
    </select>
    <span class="error-text" id="error-education-certificate-type-<?=$index;?>"></span>
</section>
<section>
    <label for="education-type-<?=$index;?>">Форма обучения</label>
    <select id="education-type-<?=$index;?>" name="education[<?=$index;?>][education-type]">
        <option value="fulltime" selected>Full-time education</option>
        <option value="distance">Distance education</option>
    </select>
    <span class="error-text" id="error-education-type-<?=$index;?>"></span>
</section>
<section>
    <div class="period-date clearfix" id="ass-study-period-<?=$index;?>" data-msg="error-ass-study-period-<?=$index;?>" data-role="period-date">
        <div>
            <div class="from-date clearfix">
                <label>Период обучения, c</label>
                <select title="" class="month" name="education[<?=$index;?>][ass-study-from-m]" id="ass-study-from-m-<?=$index;?>"
                        required data-class="ass-study-period-<?=$index;?>" data-role="select">
                    <option value="" disabled selected>Month</option>
					<?= getMonthOptions(); ?>
                </select>

                <select title="" class="year" name="education[<?=$index;?>][ass-study-from-y]" id="ass-study-from-y-<?=$index;?>"
                        required data-class="ass-study-period-<?=$index;?>" data-role="select">
                    <option value="" disabled selected>Year</option>
					<?= getYearOptions(); ?>
                </select>
            </div>
            <div class="to-date clearfix">
                <label>по</label>
                <select title="" id="ass-study-to-m-<?=$index;?>" name="education[<?=$index;?>][ass-study-to-m]" class="month"
                        required
                        data-class="ass-study-period-<?=$index;?>" data-role="select">
                    <option value="" disabled selected>Month</option>
					<?= getMonthOptions(); ?>
                </select>

                <select title="" id="ass-study-to-y-<?=$index;?>" name="education[<?=$index;?>][ass-study-to-y]" class="year"
                        required data-class="ass-study-period-<?=$index;?>" data-role="select">
                    <option value="" disabled selected>Year</option>
					<?= getYearOptions(); ?>
                </select>
            </div>
        </div>
        <span class="error-text" id="error-ass-study-period-<?=$index;?>"></span>
    </div>
</section>