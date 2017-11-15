<?php ?>
<div class="delete-copy"><span class="added-file-delete" data-parent="#part-educ" data-del="-copy<?= $index; ?>"><i
                class="fa fa-times"></i></span></div>
<section>
    <label for="part-educ-name-<?= $index; ?>">Наименование учебного заведения</label>
    <input type="text" name="part-educ[<?=$index;?>][part-educ-name]" id="part-educ-name-<?= $index; ?>" data-role="text">
    <span class="error-text" id="error-part-educ-name-<?= $index; ?>"></span>
</section>
<section>
    <label for="part-educ-specialty-<?= $index; ?>">Факультет, специальность</label>
    <input type="text" name="part-educ[<?=$index;?>][part-educ-specialty]" id="part-educ-specialty-<?= $index; ?>" data-role="text">
    <span class="error-text" id="error-part-educ-specialty-<?= $index; ?>"></span>
</section>
<section>
    <label for="part-educ-country-<?= $index; ?>">Город, страна</label>
    <input type="text" name="part-educ[<?=$index;?>][part-educ-country]" id="part-educ-country-<?= $index; ?>" data-role="text">
    <span class="error-text" id="error-part-educ-country-<?= $index; ?>"></span>
</section>
<section>
    <label for="part-educ-level-<?= $index; ?>">Уровень образования</label>
    <select id="part-educ-level-<?= $index; ?>" name="part-educ[<?=$index;?>][part-educ-level]" required data-role="select">
        <option value="" disabled selected>- Выбрать -</option>
        <option value="preschool">Preschool</option>
        <option value="primary">Primary</option>
        <option value="secondary">Secondary</option>
        <option value="higher">Tertiary (higher)</option>
        <option value="vocational">Vocational</option>
        <option value="special">Special</option>
    </select>
    <span class="error-text" id="error-part-educ-level-<?= $index; ?>"></span>
</section>
<section>
    <label for="part-educ-certificate-type-<?= $index; ?>">Тип свидетельства об образовании (диплом,
        сертификат, свидетельство)</label>
    <select id="part-educ-certificate-type-<?= $index; ?>" name="part-educ[<?=$index;?>][part-educ-certificate-type]" required
            data-role="select">
        <option value="" disabled selected>- Выбрать -</option>
        <option value="diploma">Diploma</option>
        <option value="certificate">Certificate</option>
        <option value="testimonial">Testimonial</option>
    </select>
    <span class="error-text" id="error-part-educ-certificate-type-<?= $index; ?>"></span>
</section>
<section>
    <label for="part-educ-type-<?= $index; ?>">Форма обучения</label>
    <select id="part-educ-type-<?= $index; ?>" name="part-educ[<?=$index;?>][part-educ-type]" data-role="select">
        <option value="fulltime" selected>Full-time education</option>
        <option value="distance">Distance education</option>
    </select>
    <span class="error-text" id="error-part-educ-type-<?= $index; ?>"></span>
</section>
<section>
    <div class="period-date clearfix" id="part-educ-period-<?= $index; ?>"
         data-msg="error-part-educ-period-<?= $index; ?>" data-role="period-date">
        <div>
            <div class="from-date clearfix">
                <label>Период обучения, c</label>
                <select title="" class="month" name="part-educ[<?=$index;?>][part-educ-from-m]" id="part-educ-from-m-<?= $index; ?>"
                        required data-class="part-educ-period-<?= $index; ?>" data-role="select">
                    <option value="" disabled selected>Month</option>
					<?= getMonthOptions(); ?>
                </select>

                <select title="" class="year" name="part-educ[<?=$index;?>][part-educ-from-y]" id="part-educ-from-y-<?= $index; ?>"
                        required data-class="part-educ-period-<?= $index; ?>" data-role="select">
                    <option value="" disabled selected>Year</option>
					<?= getYearOptions(); ?>
                </select>
            </div>
            <div class="to-date clearfix">
                <label>по</label>
                <select title="" id="part-educ-to-m-<?= $index; ?>" name="part-educ[<?=$index;?>][part-educ-to-m]" class="month" required
                        data-class="part-educ-period-<?= $index; ?>" data-role="select">
                    <option value="" disabled selected>Month</option>
					<?= getMonthOptions(); ?>
                </select>

                <select title="" id="part-educ-to-y-<?= $index; ?>" name="part-educ[<?=$index;?>][part-educ-to-y]" class="year" required
                        data-class="part-educ-period-<?= $index; ?>" data-role="select">
                    <option value="" disabled selected>Year</option>
					<?= getYearOptions(); ?>
                </select>
            </div>
        </div>
        <span class="error-text" id="error-part-educ-period-<?= $index; ?>"></span>
    </div>
</section>
