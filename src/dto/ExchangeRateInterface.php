<?php

namespace unapi\cbr\dto;

use unapi\interfaces\DtoInterface;

interface ExchangeRateInterface extends DtoInterface
{
    /**
     * @return int
     */
    public function getNumCode(): int;

    /**
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface;

    /**
     * @return int
     */
    public function getNominal(): int;

    /**
     * @return float
     */
    public function getValue(): float;
}