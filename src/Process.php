<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-PHP-API
 * @link https://github.com/itpanda-llc
 */

namespace Panda\MikBill\Chelinvest\GorodAPI;

/**
 * Class Process
 * @package Panda\MikBill\Chelinvest\GorodAPI
 * Состояние платежа
 */
class Process
{
    /**
     * Принят / Ожидает зачисления
     */
    public const ACCEPTED = 1;

    /**
     * Зачислен
     */
    public const CREDITED = 0;
}
