<?php

namespace MoneySolver;


class CurrencySub extends AbstractCurrency implements CurrencyInterface
{
    /**
     * @var CurrencyInterface
     */
    private $currencyLeft;
    /**
     * @var CurrencyInterface
     */
    private $currencyRight;

    public function __construct(CurrencyInterface $currencyLeft, CurrencyInterface $currencyRight)
    {
        $this->currencyLeft = $currencyLeft;
        $this->currencyRight = $currencyRight;
    }

    public function describe(): string
    {
        return $this->currencyLeft->describe() . " - " . $this->currencyRight->describe();
    }

    public function asFloat(array $quotations): float
    {
        return $this->currencyLeft->asFloat($quotations) - $this->currencyRight->asFloat($quotations);
    }

    public function collapse(): array
    {
        $result = $this->currencyLeft->collapse();
        foreach ($this->currencyRight->collapse() as $type => $price) {
            if(isset($result[$type])) {
                $result[$type] -= $price;
            }
            else {
                $result[$type] = -$price;
            }
        }
        return $result;
    }
}