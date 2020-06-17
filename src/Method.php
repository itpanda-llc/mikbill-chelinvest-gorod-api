<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-PHP-API
 * @link https://github.com/itpanda-llc
 */

namespace Panda\MikBill\Chelinvest\GorodAPI;

/**
 * Class Method
 * @package Panda\MikBill\Chelinvest\GorodAPI
 * Методы запроса
 */
class Method
{
    /**
     * Проверка аккаунта
     */
    public const CHECK = 'check';

    /**
     * Проведение платежа
     */
    public const PAY = 'pay';
}
