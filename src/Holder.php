<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-PHP-API
 * @link https://github.com/itpanda-llc
 */

namespace Panda\MikBill\Chelinvest\GorodAPI;

/**
 * Class Holder
 * @package Panda\MikBill\Chelinvest\GorodAPI
 * Наименования параметров (SQL-запросы)
 */
class Holder
{
    /**
     * Аккаунт
     */
    public const ACCOUNT = ':account';

    /**
     * Размер платежа
     */
    public const SUM = ':sum';

    /**
     * Номер платежа
     */
    public const PAY_ID = ':payId';
}
