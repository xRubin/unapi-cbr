<?php

use unapi\cbr\CbrExchangeRateService;
use unapi\cbr\CbrClient;
use unapi\helper\money\Currency;
use unapi\helper\money\MoneyAmount;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;

class CbrExchangeRateTest extends TestCase
{
    public function testDetection()
    {
        $handler = HandlerStack::create(new MockHandler([
            new Response(200, [], '<?xml version="1.0" encoding="utf-8"?><ValCurs Date="19.04.2017" name="Foreign Currency Market"><Valute ID="R01239"><NumCode>978</NumCode><CharCode>EUR</CharCode><Nominal>1</Nominal><Name>Евро</Name><Value>59,6124</Value></Valute></ValCurs>')
        ]));

        $service = new CbrExchangeRateService([
            'client' => new CbrClient(['handler' => $handler])
        ]);

        $this->assertEquals(
            $service->getExchangeRate(
                new Currency(Currency::EUR),
                new DateTimeImmutable('2017-04-19')
            )->wait(),
            new MoneyAmount(59.6124, new Currency(Currency::RUB))
        );
    }
}