<?php
namespace MoneySolver;


class Currency extends AbstractCurrency implements CurrencyInterface
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var int
     */
    private $price;

    public function __construct(string $type, int $price)
    {
        $this->type = $type;
        $this->price = $price;
    }

    public function describe(): string
    {
        return "{$this->price}{$this->type}";
    }

    public function asFloat(array $quotations): float
    {
        return $quotations[$this->type] * $this->price;
    }

    public function collapse(): array
    {
        return [$this->type => $this->price];
    }
}