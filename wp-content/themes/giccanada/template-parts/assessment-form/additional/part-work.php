<?php ?>
<?php ?>
<div class="delete-copy"><span class="added-file-delete" data-parent="#part-work" data-del="-copy<?= $index; ?>"><i
                class="fa fa-times"></i></span></div>
<section>
    <label for="part-work-name-<?=$index;?>">Наименование компании / нанимателя</label>
    <input type="text" name="part-work[<?=$index;?>][part-work-name]" id="part-work-name-<?=$index;?>" data-role="text" required>
    <span class="error-text" id="error-part-work-name-<?=$index;?>"></span>
</section>
<section>
    <label for="part-work-country-<?=$index;?>">Город, страна</label>
    <input type="text" name="part-work[<?=$index;?>][part-work-country]" id="part-work-country-<?=$index;?>" data-role="text" required>
    <span class="error-text" id="error-part-work-country-<?=$index;?>"></span>
</section>
<section>
    <label for="part-work-position-<?=$index;?>">Должность</label>
    <input type="text" name="part-work[<?=$index;?>][part-work-position]" id="part-work-position-<?=$index;?>" data-role="text" required>
    <span class="error-text" id="error-part-work-position-<?=$index;?>"></span>
</section>
<section>
    <div class="period-date clearfix" id="ass-part-work-period-<?=$index;?>" data-msg="error-ass-part-work-period-<?=$index;?>" data-role="period-date">
        <div>
            <div class="from-date clearfix">
                <label>Период работы, c</label>
                <select title="" class="month" name="part-work[<?=$index;?>][ass-part-work-from-m]" id="ass-part-work-from-m-<?=$index;?>"
                        required data-class="ass-part-work-period-<?=$index;?>" data-role="select">
                    <option value="" disabled selected>Month</option>
					<?= getMonthOptions(); ?>
                </select>

                <select title="" class="year" name="part-work[<?=$index;?>][ass-part-work-from-y]" id="ass-part-work-from-y-<?=$index;?>"
                        required data-class="ass-part-work-period-<?=$index;?>" data-role="select">
                    <option value="" disabled selected>Year</option>
					<?= getYearOptions(); ?>
                </select>
            </div>
            <div class="to-date clearfix">
                <label>по</label>
                <select title="" id="ass-part-work-to-m-<?=$index;?>" name="part-work[<?=$index;?>][ass-part-work-to-m]" class="month"
                        required data-class="ass-part-work-period-<?=$index;?>" data-role="select">
                    <option value="" disabled selected>Month</option>
					<?= getMonthOptions(); ?>
                </select>

                <select title="" id="ass-part-work-to-y-<?=$index;?>" name="part-work[<?=$index;?>][ass-part-work-to-y]" class="year"
                        required data-class="ass-part-work-period-<?=$index;?>" data-role="select">
                    <option value="" disabled selected>Year</option>
					<?= getYearOptions(); ?>
                </select>
            </div>
            <span class="error-text" id="error-ass-part-work-period-<?=$index;?>"></span>
        </div>
    </div>
</section>
<section>
    <label for="part-work-requirement-<?=$index;?>">Должностные обязанности</label>
    <textarea name="part-work[<?=$index;?>][part-work-requirement]" id="part-work-requirement-<?=$index;?>" rows="4"
              cols="50" data-role="mixed" required></textarea>
    <span class="error-text" id="error-part-work-requirement-<?=$index;?>"></span>
</section>
