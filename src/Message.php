<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-PHP-API
 * @link https://github.com/itpanda-llc
 */

namespace Panda\MikBill\Chelinvest\GorodAPI;

/**
 * Class Message
 * @package Panda\MikBill\Chelinvest\GorodAPI
 * Сообщения ответа
 */
class Message
{
    /**
     * Код: 1
     */
    public const REQUEST_ERROR = 'Неправильный запрос';

    /**
     * Код: 1
     */
    public const ACCOUNT_ERROR = 'Аккаунт не найден';

    /**
     * Код: 10
     */
    public const PAYMENT_ERROR = 'Платеж не принят';
}
