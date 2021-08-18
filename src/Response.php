<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Response
 * @package Panda\MikBill\Chelinvest\GorodApi
 * Формирование ответа
 */
class Response
{
    /**
     * @param int $code Код
     * @param string $message Сообщение
     * @return string Контент
     */
    public static function getError(int $code,
                                    string $message): string
    {
        $sxe = self::getXmlElement();

        $sxe->addChild(Tag::CODE, (string) $code);
        $sxe->addChild(Tag::MESSAGE, $message);

        return $sxe->asXML();
    }

    /**
     * @param array $account Информация об аккаунте
     * @return string Контент
     */
    public static function getAccount(array $account): string
    {
        $sxe = self::getXmlElement();

        $sxe->addChild(Tag::CODE, (string) Code::DEFAULT);
        $sxe->addChild(Tag::CLIENT, $account[Field::CLIENT]);
        $sxe->addChild(Tag::ACCOUNT, $account[Field::ACCOUNT]);
        $sxe->addChild(Tag::BALANCE, $account[Field::BALANCE]);
        $sxe->addChild(Tag::STATUS, $account[Field::STATUS]);
        $sxe->addChild(Tag::SERVICE, $_ENV['SERVICE_NAME']);
        $sxe->addChild(Tag::ADDRESS, $account[Field::ADDRESS]);
        $sxe->addChild(Tag::CONTRACT, $account[Field::CONTRACT]);
        $sxe->addChild(Tag::CONTACT, $account[Field::CONTACT]);

        return $sxe->asXML();
    }

    /**
     * @param array $payment Информация о платеже
     * @param int $processCode Код статуса платежа
     * @return string Контент
     */
    public static function getPayment(array $payment,
                                      int $processCode): string
    {
        $sxe = self::getXmlElement();

        $sxe->addChild(Tag::CODE, (string) Code::DEFAULT);
        $sxe->addChild(Tag::PLAT_ID, $payment[Field::PLAT_ID]);
        $sxe->addChild(Tag::STATUS, (string) $processCode);
        $sxe->addChild(Tag::DATE, $payment[Field::DATE]);

        return $sxe->asXML();
    }

    /**
     * @return \SimpleXMLElement Объект контента
     */
    private static function getXmlElement(): \SimpleXMLElement
    {
        try {
            return new \SimpleXMLElement(
                sprintf("<?xml version=\"1.0\" encoding=\"%s\"?><%s/>",
                    $_ENV['RESPONSE_CHARSET'],
                    Tag::ANSWER));
        } catch (\Exception $e) {
            throw new Exception\DebugException($e->getMessage());
        }
    }
}
