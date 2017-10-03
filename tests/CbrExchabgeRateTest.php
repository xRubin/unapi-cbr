<?php

use unapi\cbr\CbrExchangeRateService;
use unapi\cbr\dto\CurrencyDto;
use unapi\cbr\dto\ExchangeRateDto;

class CbrExchabgeRateTest extends \PHPUnit_Framework_TestCase
{
    public function testDetection()
    {
        $service = new CbrExchangeRateService();
        $currency = new CurrencyDto('EUR');

        $this->assertEquals(
            $service->getExchangeRate($currency, new DateTimeImmutable('2017-04-19'))->wait(),
            ExchangeRateDto::toDto([
                'numCode' => 978,
                'currency' => $currency,
                'nominal' => 1,
                'value' => 59.6124,
            ])
        );
    }
}