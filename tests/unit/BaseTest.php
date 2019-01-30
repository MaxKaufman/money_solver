<?php

use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{

    /**
     * @test
     */
    public function asFloat()
    {
        $a = RUB(10)->mul(5);
        $b = ($a->add(USD(5))->sub(RUB(3)))->mul(2);

        $this->assertEquals(726.3, $b->asFloat(['RUB' => 1, 'USD' => 63.23]));
    }

    /**
     * @test
     */
    public function describe()
    {
        $a = RUB(10)->mul(5);
        $b = ($a->add(USD(5))->sub(RUB(3)))->mul(2);

        $this->assertEquals("(10RUB) * 5", $a->describe());
        $this->assertEquals("((10RUB) * 5 + 5USD - 3RUB) * 2", $b->describe());
    }

    /**
     * @test
     */
    public function collapse()
    {
        $a = RUB(10)->mul(5);
        $b = ($a->add(USD(5))->sub(RUB(3)))->mul(2);

        $this->assertEquals(['RUB' => 94, 'USD' => 10], $b->collapse());
    }

    /**
     * @test
     */
    public function emptyCurrency()
    {
        $a = RUB(10);
        $b = USD(20);

        $this->assertEquals(10.0, $a->asFloat(['RUB' => 1]));
        $this->assertEquals(50.0, $b->asFloat(['USD' => 2.5]));
        $this->assertEquals(['RUB' => 10], $a->collapse());
        $this->assertEquals(['USD' => 20], $b->collapse());
        $this->assertEquals('10RUB', $a->describe());
        $this->assertEquals('20USD', $b->describe());
    }

    /**
     * @test
     */
    public function currencySum()
    {
        $a = RUB(10);
        $b = USD(20);
        $c = $b->add($a);

        $this->assertEquals(20.0, $c->asFloat(['RUB' => 1, "USD" => 0.5]));
        $this->assertEquals('20USD + 10RUB', $c->describe());
        $this->assertEquals(['RUB' => 10, 'USD' => 20], $c->collapse());
        $this->assertEquals('10RUB', $a->describe());
        $this->assertEquals('20USD', $b->describe());
    }

    /**
     * @test
     */
    public function currencySub()
    {
        $a = RUB(10);
        $b = USD(20);
        $c = $b->sub($a);

        $this->assertEquals(0.0, $c->asFloat(['RUB' => 1, "USD" => 0.5]));
        $this->assertEquals('20USD - 10RUB', $c->describe());
        $this->assertEquals(['USD' => 20, 'RUB' => -10], $c->collapse());
        $this->assertEquals('10RUB', $a->describe());
        $this->assertEquals('20USD', $b->describe());
    }

    /**
     * @test
     */
    public function currencyMul()
    {
        $a = RUB(10);
        $b = USD(20);
        $c = $a->add($b->mul(5));

        $this->assertEquals(60.0, $c->asFloat(['RUB' => 1, "USD" => 0.5]));
        $this->assertEquals('10RUB + (20USD) * 5', $c->describe());
        $this->assertEquals(['RUB' => 10, 'USD' => 100], $c->collapse());
        $this->assertEquals('10RUB', $a->describe());
        $this->assertEquals('20USD', $b->describe());
    }

}