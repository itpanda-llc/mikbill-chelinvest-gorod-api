<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Key
 * @package Panda\MikBill\Chelinvest\GorodApi
 * Наименование полей в ответе
 */
class Field
{
    /**
     * Клиент
     */
    public const CLIENT = 'client';

    /**
     * Аккаунт
     */
    public const ACCOUNT = 'account';

    /**
     * Баланс
     */
    public const BALANCE = 'balance';

    /**
     * Статус аккаунта/платежа
     */
    public const STATUS = 'status';

    /**
     * Адрес
     */
    public const ADDRESS = 'address';

    /**
     * Информация о договоре
     */
    public const CONTRACT = 'contract';

    /**
     * Контактная информация
     */
    public const CONTACT = 'contact';

    /**
     * Номер платежа
     */
    public const PLAT_ID = 'plat_id';

    /**
     * Дата регистрации платежа
     */
    public const DATE = 'date';
}
