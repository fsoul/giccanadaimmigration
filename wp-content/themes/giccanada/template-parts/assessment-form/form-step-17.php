<section class="radio-block payment-method">
    <label>Способ оплаты</label>
    <section>
        <input name="ass-payment-type" class="ass-radio" value="tc" type="radio" id="ass-target-card" required data-role="radio">
        <label for="ass-target-card" onclick="app.func.paymentMethodClick(event);">Платежная карта
            <span class="payment-type-logo"><span id="visa-logo"></span><span id="master-logo"></span><span
                        id="maestro-logo"></span></span></label>
        <div class="payment-panel">
            <section>
                <label for="holder-full-name">Имя и фамилия держателя карты</label>
                <input type="text" name="holder-full-name" id="holder-full-name" placeholder="Card Holder" data-role="text">
                <span class="error-text" id="error-holder-full-name"></span>
            </section>
            <section>
                <label for="holder-card-num">Номер карты</label>
                <input type="text" name="holder-card-num" id="holder-card-num" placeholder="XXXX - XXXX - XXXX - XXXX"
                       data-role="card-number">
                <span class="error-text" id="error-holder-card-num"></span>
            </section>
            <section class="clearfix">
                <div class="expiration-date clearfix">
                    <label>Срок действия</label>
                    <select title="" id="card-expiration-date-m" name="card-expiration-date-m" class="month"
                            required data-role="select">
                        <option value="" disabled selected>Month</option>
						<?= getMonthOptions(); ?>
                    </select>
                    <span class="error-text" id="error-card-expiration-date-m"></span>

                    <select title="" id="card-expiration-date-y" name="card-expiration-date-y" class="year"
                            required data-role="select">
                        <option value="" disabled selected>Year</option>
						<?= getExpirationDateYearsOptions(); ?>
                    </select>
                    <span class="error-text" id="error-card-expiration-date-y"></span>
                </div>
                <section id="holder-cvc-container">
                    <label for="holder-cvc">CVV2/CVC2</label>
                    <input type="password" name="holder-cvc" id="holder-cvc" placeholder="***" maxlength="3"
                           data-role="cvc">
                    <span class="error-text" id="error-holder-cvc"></span>
                </section>
            </section>
        </div>
    </section>
    <section>
        <input name="ass-payment-type" class="ass-radio" value="pp" type="radio" id="ass-paypal" data-role="radio">
        <label for="ass-paypal" onclick="app.func.paymentMethodClick(event);">PayPal
            <span class="payment-type-logo"><span id="paypal-logo"></span></span></label>
    </section>
    <section>
        <input name="ass-payment-type" class="ass-radio" value="wu" type="radio" id="ass-west-un" data-role="radio">
        <label for="ass-west-un" onclick="app.func.paymentMethodClick(event);">Western Union online</label>
    </section>
    <section>
        <input name="ass-payment-type" class="ass-radio" value="bw" type="radio" id="ass-bank-wire" data-role="radio">
        <label for="ass-bank-wire" onclick="app.func.paymentMethodClick(event);">Банковский перевод</label>
        <div class="payment-panel">
            <section>
                <label>Информация для банковского перевода</label>
                <span class="payment-bank-info">Account Name: GIC CANADA IMMIGRATION</span>
                <span class="payment-bank-info">Bank Name: Bank of America</span>
                <span class="payment-bank-info">Account #: 898088015478</span>
                <span class="payment-bank-info">SWIFT: 026009593</span>
                <span class="payment-bank-info">Bank Address: 19645 Biscayne Blvd Aventura, FL 33180, USA</span>
            </section>
        </div>
    </section>
       <section class="ass-licence">
        <p>
            После оплаты за открытие иммиграционного файла, Ваше дело будет изучено специалистами нашей компании, и <b>в
                течении 3 рабочих дней</b> вы получите контракт на подходящую для вас иммиграционную программу.
        </p>
        <div>
            <input type="checkbox" value="y" id="ass-licence-cb" name="is-agree" required data-role="checkbox"/>
            <label for="ass-licence-cb"><span>Я прочитал и принимаю условия <a href="#" class="ass-licence-link">Пользовательского соглашения</a>.</span></label>
        </div>
    </section>
</section>
