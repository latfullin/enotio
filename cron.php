<?php

require __DIR__ . '/vendor/autoload.php';

(new \App\Service\ExchangeRatesService())->checkExchangeRate();
