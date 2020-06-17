<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-PHP-API
 * @link https://github.com/itpanda-llc
 */

namespace Panda\MikBill\Chelinvest\GorodAPI;

use Panda\MikBill\Chelinvest\GorodAPI\Exception\DebugException;

/**
 * Class Config
 * @package Panda\MikBill\Chelinvest\GorodAPI
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
        if (!isset(self::$sxe)) {
            try {
                self::$sxe = new \SimpleXMLElement(CONFIG,
                    LIBXML_ERR_NONE,
                    true);
            } catch (\Exception $e) {
                throw new DebugException($e->getMessage());
            }
        }

        return self::$sxe;
    }
}
