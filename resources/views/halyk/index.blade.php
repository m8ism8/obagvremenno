

<script src="https://test-epay.homebank.kz/payform/payment-api.js">
</script>
<script>
    var createPaymentObject = function(auth, invoiceId, amount) {
        var paymentObject = {
            invoiceId: "000001",
            backLink: "https://example.kz/success.html",
            failureBackLink: "https://example.kz/failure.html",
            postLink: "https://example.kz/",
            failurePostLink: "https://example.kz/order/1123/fail",
            language: "RU",
            description: "Оплата в интернет магазине",
            accountId: "testuser1",
            terminal: "TerminalID",
            amount: 10000,
            currency: "KZT",
            cardSave: true  //Параметр должен передаваться как Boolean
        };
        paymentObject.auth = auth;
        return paymentObject;
    };

    halyk.showPaymentWidget(createPaymentObject('QKUFXNDTORMVYI4P-BBBCA', invoiceId, amount), callBk);
</script>
<?php
