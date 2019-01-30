<?php
namespace MoneySolver;

abstract class AbstractCurrency implements CurrencyInterface
{
    public function mul(int $multiplier): CurrencyInterface
    {
        return new CurrencyMul($this, $multiplier);
    }

    public function sub(CurrencyInterface $currency): CurrencyInterface
    {
        return new CurrencySub($this, $currency);
    }

    public function add(CurrencyInterface $currency): CurrencyInterface
    {
        return new CurrencySum($this, $currency);
    }

    public function describe(): string
    {
    }

    public function asFloat(array $quotations): float
    {
    }

    public function collapse(): array
    {
    }
}