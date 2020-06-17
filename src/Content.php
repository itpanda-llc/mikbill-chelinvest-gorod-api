<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-PHP-API
 * @link https://github.com/itpanda-llc
 */

namespace Panda\MikBill\Chelinvest\GorodAPI;

/**
 * Class Content
 * @package Panda\MikBill\Chelinvest\GorodAPI
 * Заголовок ответа (Тип контента)
 */
class Content
{
    /**
     * text/xml; windows-1251
     */
    public const XML_TYPE = 'Content-Type: text/xml; charset=' . Charset::WINDOWS_1251;
}
