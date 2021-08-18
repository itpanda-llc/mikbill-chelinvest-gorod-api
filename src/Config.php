<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Config
 * @package Panda\MikBill\Chelinvest\GorodApi
 * Получение конфигурации
 */
class Config
{
    /**
     * @var \SimpleXMLElement Объект конфигурационного файла
     */
    private static $sxe;

    /**
     * @return \SimpleXMLElement Объект конфигурационного файла
     */
    public static function get(): \SimpleXMLElement
    {
        if (!isset(self::$sxe))
            try {
                self::$sxe = new \SimpleXMLElement($_ENV['MIKBILL_CONFIG'],
                    LIBXML_ERR_NONE,
                    true);
            } catch (\Exception $e) {
                throw new Exception\DebugException($e->getMessage());
            }

        return self::$sxe;
    }
}
