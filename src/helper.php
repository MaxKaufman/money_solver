<?php
function USD(int $price): \MoneySolver\CurrencyInterface
{
    return new MoneySolver\Currency("USD", $price);
}

function RUB(int $price): \MoneySolver\CurrencyInterface
{
    return new MoneySolver\Currency("RUB", $price);
}

