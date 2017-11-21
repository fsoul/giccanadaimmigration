<section class="radio-block payment-method">
    <label>Способ оплаты</label>
    <input type="hidden" id="ass-payment-type-hidden" value="tc">
    <section>
        <input name="ass-payment-type" class="ass-radio" value="tc" type="radio" id="ass-target-card" required data-role="radio"
               data-hidden="ass-payment-type-hidden" checked>
        <label for="ass-target-card" onclick="app.func.paymentMethodClick(event);">Платежная карта
            <span class="payment-type-logo"><span id="visa-logo"></span><span id="master-logo"></span><span
                        id="maestro-logo"></span></span></label>
    </section>
    <section>
        <input name="ass-payment-type" class="ass-radio" value="pp" type="radio" id="ass-paypal" data-role="radio"
               data-hidden="ass-payment-type-hidden">
        <label for="ass-paypal" onclick="app.func.paymentMethodClick(event);">PayPal
            <span class="payment-type-logo"><span id="paypal-logo"></span></span></label>
    </section>
    <section>
        <input name="ass-payment-type" class="ass-radio" value="wu" type="radio" id="ass-west-un" data-role="radio"
               data-hidden="ass-payment-type-hidden">
        <label for="ass-west-un" onclick="app.func.paymentMethodClick(event);">Western Union online</label>
    </section>
    <section>
        <input name="ass-payment-type" class="ass-radio" value="bw" type="radio" id="ass-bank-wire" data-role="radio"
               data-hidden="ass-payment-type-hidden">
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
            <input type="checkbox" onchange="app.func.onLicenseChange();" value="y" id="ass-licence-cb" name="is-agree" required checked data-role="checkbox"/>
            <label for="ass-licence-cb"><span>Я прочитал и принимаю условия <a href="#" class="ass-licence-link">Пользовательского соглашения</a>.</span></label>
    </section>
</section>