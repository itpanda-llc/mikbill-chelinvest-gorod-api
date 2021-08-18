<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Process
 * @package Panda\MikBill\Chelinvest\GorodApi
 * Состояние платежа
 */
class Process
{
    /**
     * Принят / Ожидает зачисления
     */
    private const ACCEPT_CODE = 1;

    /**
     * Зачислен
     */
    private const CREDIT_CODE = 0;

    /**
     * @param string $status Статус платежа
     * @return int Код статуса платежа
     */
    public static function getCode(string $status): int
    {
        return ($status === '0')
            ? self::ACCEPT_CODE
            : self::CREDIT_CODE;
    }
}
