<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-PHP-API
 * @link https://github.com/itpanda-llc
 */

namespace Panda\MikBill\Chelinvest\GorodAPI;

/**
 * Class Code
 * @package Panda\MikBill\Chelinvest\GorodAPI
 * Код ответа
 */
class Code
{
    /**
     * Успешное выполнение запроса
     */
    public const DEFAULT = 0;

    /**
     * Информация об ошибке
     */
    public const ERROR = 1;

    /**
     * Информация для отладки
     */
    public const DEBUG = 10;
}
