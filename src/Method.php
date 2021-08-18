<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Method
 * @package Panda\MikBill\Chelinvest\GorodApi
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
