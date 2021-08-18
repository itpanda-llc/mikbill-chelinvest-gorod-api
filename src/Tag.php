<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Tag
 * @package Panda\MikBill\Chelinvest\GorodApi
 * Наименования полей в ответе
 */
class Tag
{
    /**
     * Основное / Главный тег
     */
    public const ANSWER = 'Answer';

    /**
     * Код
     */
    public const CODE = 'Code';

    /**
     * Сообщение
     */
    public const MESSAGE = 'Message';

    /**
     * Клиент
     */
    public const CLIENT = 'Client';

    /**
     * Аккаунт
     */
    public const ACCOUNT = 'Account';

    /**
     * Баланс
     */
    public const BALANCE = 'Balance';

    /**
     * Статус аккаунта / платежа
     */
    public const STATUS = 'Status';

    /**
     * Наименование сервиса
     */
    public const SERVICE = 'Service';

    /**
     * Адрес
     */
    public const ADDRESS = 'Address';

    /**
     * Информация о договоре
     */
    public const CONTRACT = 'Contract';

    /**
     * Контактная информация
     */
    public const CONTACT = 'Contact';

    /**
     * Номер платежа
     */
    public const PLAT_ID = 'PlatID';

    /**
     * Дата регистрации платежа
     */
    public const DATE = 'Date';
}
