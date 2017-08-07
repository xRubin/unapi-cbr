<?php
namespace unapi\cbr;

class CbrCurrencyResponse
{
    /** @var int */
    private $numCode;
    /** @var CbrCurrency */
    private $currency;
    /** @var int */
    private $nominal;
    /** @var float */
    private $value;

    /**
     * CbrCurrencyResponse constructor.
     * @param int $numCode
     * @param CbrCurrency $currency
     * @param int $nominal
     * @param float $value
     */
    public function __construct(int $numCode, CbrCurrency $currency, int $nominal, float $value)
    {
        $this->numCode = $numCode;
        $this->currency = $currency;
        $this->nominal = $nominal;
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getNumCode(): int
    {
        return $this->numCode;
    }

    /**
     * @return CbrCurrency
     */
    public function getCurrency(): CbrCurrency
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getNominal(): int
    {
        return $this->nominal;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }
}