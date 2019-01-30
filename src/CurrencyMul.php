<?php
namespace MoneySolver;


class CurrencyMul extends AbstractCurrency implements CurrencyInterface
{

    /**
     * @var CurrencyInterface
     */
    private $currency;
    /**
     * @var int
     */
    private $multiplier;

    public function __construct(CurrencyInterface $currency, int $multiplier)
    {

        $this->currency = $currency;
        $this->multiplier = $multiplier;
    }

    public function describe(): string
    {
        return "({$this->currency->describe()}) * {$this->multiplier}";
    }

    public function asFloat(array $quotations): float
    {
        return $this->currency->asFloat($quotations) * $this->multiplier;
    }

    public function collapse(): array
    {
        $result = $this->currency->collapse();
        foreach ($result as $type => $price) {
            $result[$type] *= $this->multiplier;
        }

        return $result;
    }
}