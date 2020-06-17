<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-PHP-API
 * @link https://github.com/itpanda-llc
 */

namespace Panda\MikBill\Chelinvest\GorodAPI;

use Panda\MikBill\Chelinvest\GorodAPI\Exception\DebugException;

/**
 * Class Response
 * @package Panda\MikBill\Chelinvest\GorodAPI
 * Формирование ответа
 */
class Response
{
    /**
     * @param int $code Код
     * @param string $message Сообщение
     * @return string XML-контент
     */
    public static function getError(int $code,
                                    string $message): string
    {
        $sxe = self::getXMLElement();

        $sxe->addChild(Field::CODE, (string) $code);
        $sxe->addChild(Field::MESSAGE, $message);

        return $sxe->asXML();
    }

    /**
     * @param array $account Информация об аккаунте
     * @return string XML-контент
     */
    public static function getAccount(array $account): string
    {
        $sxe = self::getXMLElement();

        $sxe->addChild(Field::CODE, (string) Code::DEFAULT);
        $sxe->addChild(Field::CLIENT, $account[Field::CLIENT]);
        $sxe->addChild(Field::ACCOUNT, $account[Field::ACCOUNT]);
        $sxe->addChild(Field::BALANCE, $account[Field::BALANCE]);
        $sxe->addChild(Field::STATUS, $account[Field::STATUS]);
        $sxe->addChild(Field::SERVICE, Service::NAME);
        $sxe->addChild(Field::ADDRESS, $account[Field::ADDRESS]);
        $sxe->addChild(Field::CONTRACT, $account[Field::CONTRACT]);
        $sxe->addChild(Field::CONTACT, $account[Field::CONTACT]);

        return $sxe->asXML();
    }

    /**
     * @param array $payment Информация о платеже
     * @return string XML-контент
     */
    public static function getPayment(array $payment): string
    {
        $sxe = self::getXMLElement();

        $sxe->addChild(Field::CODE, (string) Code::DEFAULT);
        $sxe->addChild(Field::PLAT_ID, $payment[Field::PLAT_ID]);
        $sxe->addChild(Field::STATUS, $payment[Field::STATUS]);
        $sxe->addChild(Field::DATE, $payment[Field::DATE]);

        return $sxe->asXML();
    }

    /**
     * @return \SimpleXMLElement Объект XML-контента
     */
    private static function getXMLElement(): \SimpleXMLElement
    {
        try {
            return new \SimpleXMLElement(
                sprintf("<?xml version=\"1.0\" encoding=\"%s\"?><%s/>",
                    Charset::WINDOWS_1251,
                    Field::MAIN));
        } catch (\Exception $e) {
            throw new DebugException($e->getMessage());
        }
    }
}
