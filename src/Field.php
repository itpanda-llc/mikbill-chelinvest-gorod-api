<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-PHP-API
 * @link https://github.com/itpanda-llc
 */

namespace Panda\MikBill\Chelinvest\GorodAPI;

/**
 * Class Field
 * @package Panda\MikBill\Chelinvest\GorodAPI
 * Наименование полей в ответе
 */
class Field
{
    /**
     * Основное / Главный тег
     */
    public const MAIN = 'Answer';

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
