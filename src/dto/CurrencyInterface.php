<?php

namespace unapi\cbr\dto;

use unapi\interfaces\DtoInterface;

interface CurrencyInterface extends DtoInterface
{
    /**
     * @return string
     */
    public function getCharCode(): string;
}