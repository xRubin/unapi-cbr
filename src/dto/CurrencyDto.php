<?php

namespace unapi\cbr\dto;

use unapi\interfaces\DtoInterface;

class CurrencyDto implements CurrencyInterface
{
    const AUD = 'AUD'; // Австралийский доллар
    const AZN = 'AZN'; // Азербайджанский манат
    const GBP = 'GBP'; // Фунт стерлингов Соединенного королевства
    const AMD = 'AMD'; // Армянский драм
    const BYN = 'BYN'; // Белорусский рубль
    const BGN = 'BGN'; // Болгарский лев
    const BRL = 'BRL'; // Бразильский реал
    const HUF = 'HUF'; // Венгерский форинт
    const HKD = 'HKD'; // Гонконгский доллар
    const DKK = 'DKK'; // Датская крона
    const USD = 'USD'; // Доллар США
    const RUB = 'RUB'; // Российский рубль
    const EUR = 'EUR'; // Евро
    const INR = 'INR'; // Индийская рупия
    const KZT = 'KZT'; // Казахстанский тенге
    const CAD = 'CAD'; // Канадский доллар
    const KGS = 'KGS'; // Киргизский сом
    const CNY = 'CNY'; // Китайский юань
    const MDL = 'MDL'; // Молдавский лей
    const NOK = 'NOK'; // Норвежская крона
    const PLN = 'PLN'; // Польский злотый
    const RON = 'RON'; // Румынский лей
    const SGD = 'SGD'; // Сингапурский доллар
    const TJS = 'TJS'; // Таджикский сомони
    const TRY = 'TRY'; // Турецкая лира
    const TMT = 'TMT'; // Новый туркменский манат
    const UZS = 'UZS'; // Узбекский сум
    const UAH = 'UAH'; // Украинская гривна
    const CZK = 'CZK'; // Чешская крона
    const CHF = 'CHF'; // Швейцарский франк
    const ZAR = 'ZAR'; // Южноафриканский рэнд
    const KRW = 'KRW'; // Вон Республики Корея
    const JPY = 'JPY'; // Японская иена

    /** @var string */
    private $charCode;

    public function __construct(string $charCode)
    {
        if (!defined("self::{$charCode}"))
            throw new \InvalidArgumentException('Currency not defined');

        $this->charCode = $charCode;
    }

    /**
     * @return string
     */
    public function getCharCode(): string
    {
        return $this->charCode;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function toDto(array $data): DtoInterface
    {
        return new CurrencyDto($data['charCode']);
    }
}