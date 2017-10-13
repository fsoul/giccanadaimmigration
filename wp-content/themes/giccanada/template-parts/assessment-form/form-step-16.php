<section class="radio-block payment-method">
    <label>Способ оплаты</label>
    <section>
        <input name="ass-payment-type" class="ass-radio" value="tc" type="radio" id="ass-target-card" required>
        <label for="ass-target-card" onclick="app.func.paymentMethodClick(event);">Платежная карта
            <span class="payment-type-logo"><span id="visa-logo"></span><span id="master-logo"></span><span id="maestro-logo"></span></span></label>
        <div class="payment-panel">
            <section>
                <label for="holder-full-name">Имя и фамилия держателя карты</label>
                <input type="text" name="holder-full-name" id="holder-full-name" placeholder="Card Holder">
            </section>
            <section>
                <label for="holder-card-num">Номер карты</label>
                <input type="text" name="holder-card-num" id="holder-card-num" placeholder="XXXX - XXXX - XXXX - XXXX">
            </section>
            <section class="clearfix">
                <div class="expiration-date clearfix">
                    <label>Срок действия</label>
                    <select title="" id="card-expiration-date-m" name="card-expiration-date-m" class="month"
                            required>
                        <option value="" disabled selected>Месяц</option>
                        <option value="1">Январь</option>
                        <option value="2">Февраль</option>
                        <option value="3">Март</option>
                        <option value="4">Апрель</option>
                        <option value="5">Май</option>
                        <option value="6">Июнь</option>
                        <option value="7">Июль</option>
                        <option value="8">Август</option>
                        <option value="9">Сентябрь</option>
                        <option value="10">Октябрь</option>
                        <option value="11">Ноябрь</option>
                        <option value="12">Декабрь</option>
                    </select>

                    <select title="" id="card-expiration-date-y" name="card-expiration-date-y" class="year"
                            required>
                        <option value="" disabled selected>Год</option>
                        <option value="">2017</option>
                        <option value="">2016</option>
                        <option value="">2015</option>
                        <option value="">2014</option>
                        <option value="">2013</option>
                        <option value="">2012</option>
                        <option value="">2011</option>
                        <option value="">2010</option>
                        <option value="">2009</option>
                        <option value="">2008</option>
                        <option value="">2007</option>
                        <option value="">2006</option>
                        <option value="">2005</option>
                    </select>
                </div>
                <section id="holder-cvc-container">
                    <label for="holder-cvc">CVV2/CVC2</label>
                    <input type="password" name="holder-cvc" id="holder-cvc" placeholder="***" maxlength="3">
                </section>
            </section>
        </div>
    </section>
    <section>
        <input name="ass-payment-type" class="ass-radio" value="pp" type="radio" id="ass-paypal">
        <label for="ass-paypal" onclick="app.func.paymentMethodClick(event);">PayPal
            <span class="payment-type-logo"><span id="paypal-logo"></span></span></label>
    </section>
    <section>
        <input name="ass-payment-type" class="ass-radio" value="bw" type="radio" id="ass-bank-wire">
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
</section>
