<?php

namespace unapi\cbr\dto;

use unapi\interfaces\DtoInterface;

class ExchangeRateDto implements ExchangeRateInterface
{
    /** @var int */
    private $numCode;
    /** @var CurrencyInterface */
    private $currency;
    /** @var int */
    private $nominal;
    /** @var float */
    private $value;

    /**
     * @return int
     */
    public function getNumCode(): int
    {
        return $this->numCode;
    }

    /**
     * @param int $numCode
     * @return ExchangeRateDto
     */
    public function setNumCode(int $numCode): ExchangeRateDto
    {
        $this->numCode = $numCode;
        return $this;
    }

    /**
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface
    {
        return $this->currency;
    }

    /**
     * @param CurrencyInterface $currency
     * @return ExchangeRateDto
     */
    public function setCurrency(CurrencyInterface $currency): ExchangeRateDto
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return int
     */
    public function getNominal(): int
    {
        return $this->nominal;
    }

    /**
     * @param int $nominal
     * @return self
     */
    public function setNominal(int $nominal): self
    {
        $this->nominal = $nominal;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return self
     */
    public function setValue(float $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param array $data
     * @return DtoInterface
     */
    public static function toDto(array $data): DtoInterface
    {
        return (new ExchangeRateDto())
            ->setCurrency($data['currency'])
            ->setNominal($data['nominal'])
            ->setNumCode($data['numCode'])
            ->setValue($data['value']);
    }
}