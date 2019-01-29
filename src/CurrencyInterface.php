<?php
namespace MoneySolver;

interface CurrencyInterface
{
    public function mul(int $multiplier): CurrencyInterface;

    public function sub(CurrencyInterface $currency): CurrencyInterface;

    public function add(CurrencyInterface $currency): CurrencyInterface;

    public function describe(): string;

    public function asFloat(array $quotations): float;

    public function collapse(): array;
}