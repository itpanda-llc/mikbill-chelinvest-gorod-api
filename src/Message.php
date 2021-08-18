<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Text
 * @package Panda\MikBill\Chelinvest\GorodApi
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
    public const SEARCH_ACCOUNT_ERROR = 'Аккаунт не найден';

    /**
     * Код: 1
     */
    public const SERVER_ERROR = 'Ошибка сервера';
}
