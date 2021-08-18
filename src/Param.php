<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Param
 * @package Panda\MikBill\Chelinvest\GorodApi
 * Наименования параметров запроса
 */
class Param
{
    /**
     * Логин
     */
    public const LOGIN = 'login';

    /**
     * Пароль
     */
    public const PASSWORD = 'password';

    /**
     * Метод
     */
    public const METHOD = 'method';

    /**
     * Аккаунт
     */
    public const ACCOUNT = 'account';

    /**
     * Номер услуги
     */
    public const SERVICE = 'service';

    /**
     * Размер платежа
     */
    public const SUM = 'summ';

    /**
     * Номер платежа
     */
    public const PAY_ID = 'payid';
}
