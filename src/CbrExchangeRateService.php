<?php
namespace unapi\cbr;

use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use unapi\cbr\dto\CurrencyInterface;
use unapi\cbr\dto\ExchangeRateDto;
use unapi\interfaces\ServiceInterface;

class CbrExchangeRateService implements ServiceInterface, LoggerAwareInterface
{
    /** @var CbrClient */
    private $client;
    /** @var LoggerInterface */
    private $logger;
    /** @var string */
    private $responseClass = ExchangeRateDto::class;

    /**
     * @param array $config Service configuration settings.
     */
    public function __construct(array $config = [])
    {
        if (!isset($config['client'])) {
            $this->client = new CbrClient();
        } elseif ($config['client'] instanceof CbrClient) {
            $this->client = $config['client'];
        } else {
            throw new \InvalidArgumentException('Client must be instance of CbrClient');
        }

        if (!isset($config['logger'])) {
            $this->logger = new NullLogger();
        } elseif ($config['logger'] instanceof LoggerInterface) {
            $this->setLogger($config['logger']);
        } else {
            throw new \InvalidArgumentException('Logger must be instance of LoggerInterface');
        }

        if (isset($config['responseClass']))
            $this->responseClass = $config['responseClass'];
    }

    /**
     * @inheritdoc
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @param CurrencyInterface $currency
     * @param \DateTimeInterface $dateTime
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getExchangeRate(CurrencyInterface $currency, \DateTimeInterface $dateTime = null): PromiseInterface
    {
        if (null === $dateTime)
            $dateTime = new \DateTimeImmutable();

        return $this->client->requestAsync('GET',  sprintf('/scripts/XML_daily.asp?date_req=%s', $dateTime->format('d.m.Y')))
            ->then(function (ResponseInterface $response) use ($currency) {
                return $this->processResult($response, $currency);
            }
        );
    }

    /**
     * @param ResponseInterface $response
     * @param CurrencyInterface $currency
     * @return PromiseInterface
     */
    protected function processResult(ResponseInterface $response, CurrencyInterface $currency): PromiseInterface
    {
        $answer = $response->getBody()->getContents();
        $this->logger->debug($answer);

        $xml =  new \SimpleXMLElement($answer);
        $result = $xml->xpath("//Valute/CharCode[text()='{$currency->getCharCode()}']/..")[0];

        return new FulfilledPromise($this->responseClass::toDto([
            'numCode' => (int)$result->NumCode,
            'currency' => $currency,
            'nominal' => (int)$result->Nominal,
            'value' => (float)str_replace(',', '.', $result->Value),
        ]));
    }
}