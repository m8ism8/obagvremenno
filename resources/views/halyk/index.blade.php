<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halyk</title>
</head>
<body>

<script src="https://test-epay.homebank.kz/payform/payment-api.js">
</script>
<script>
    var createPaymentObject = function (auth, invoiceId, amount) {
        var paymentObject = {
            invoiceId:       invoiceId,
            backLink:        "https://bag.a-lux.dev/",
            failureBackLink: "https://bag.a-lux.dev/",
            postLink:        "https://bag.a-lux.dev/",
            failurePostLink: "https://bag.a-lux.dev/",
            language:        "RU",
            description:     "Оплата в интернет магазине",
            terminal:        "67e34d63-102f-4bd1-898e-370781d0074d",
            amount:          amount,
            currency:        "KZT",
            cardSave:        false  //Параметр должен передаваться как Boolean
        };
        console.log(auth);
        paymentObject.auth = auth;
        return paymentObject;
    };
    const paymentObj        = {};

    paymentObj['access_token']  = '{{$payment['access_token']}}';
    paymentObj['expires_in']    = '{{$payment['expires_in']}}';
    paymentObj['refresh_token'] = '{{$payment['refresh_token']}}';
    paymentObj['scope']         = '{{$payment['scope']}}';
    paymentObj['token_type']    = '{{$payment['token_type']}}';

    let callBk = true;

    console.log(paymentObj);
    halyk.showPaymentWidget(createPaymentObject(paymentObj, '123124', '1'), callBk)
</script>

<?php
