<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Holder
 * @package Panda\MikBill\Chelinvest\GorodApi
 * Наименования параметров (SQL-запросы)
 */
class Holder
{
    /**
     * Аккаунт
     */
    public const ACCOUNT = ':account';

    /**
     * Номер категории платежа
     */
    public const CATEGORY_ID = ':categoryId';

    /**
     * Номер категории платежа
     */
    public const CATEGORY_NAME = ':categoryName';

    /**
     * Размер платежа
     */
    public const SUM = ':sum';

    /**
     * Номер платежа
     */
    public const PAY_ID = ':payId';

    /**
     * Комментарий платежа
     */
    public const PAYMENT_COMMENT = ':paymentComment';
}
