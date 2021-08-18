<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Query
 * @package Panda\MikBill\Chelinvest\GorodApi
 * Запросы к БД
 */
class Query
{
    /**
     * @param string $account Аккаунт
     * @return array|null Информация об аккаунте
     */
    public static function getAccount(string $account): ?array
    {
        $sth = Statement::prepare(Sql::GET_ACCOUNT);

        $sth->bindParam(Holder::ACCOUNT, $account);

        Statement::execute($sth);

        return (($result = $sth->fetch(\PDO::FETCH_ASSOC)) !== false)
            ? $result
            : null;
    }

    /**
     * @param string $payId Номер платежа
     * @return array|null Информация о платеже
     */
    public static function getPayment(string $payId): ?array
    {
        $sth = Statement::prepare(Sql::GET_PAYMENT);

        $categoryId = (int) $_ENV['CATEGORY_ID'];

        $sth->bindParam(Holder::PAY_ID, $payId);
        $sth->bindParam(Holder::CATEGORY_ID,
            $categoryId,
            \PDO::PARAM_INT);

        Statement::execute($sth);

        return (($result = $sth->fetch(\PDO::FETCH_ASSOC)) !== false)
            ? $result
            : null;
    }

    /**
     * @return bool Результат проверки категории платежа
     */
    public static function checkCategory(): bool
    {
        $sth = Statement::prepare(Sql::CHECK_CATEGORY);

        $categoryId = (int) $_ENV['CATEGORY_ID'];

        $sth->bindParam(Holder::CATEGORY_ID,
            $categoryId,
            \PDO::PARAM_INT);

        Statement::execute($sth);

        return $sth->rowCount() !== 0;
    }

    /**
     * @return bool Результат добавления категории платежа
     */
    public static function addCategory(): bool
    {
        $sth = Statement::prepare(Sql::ADD_CATEGORY);

        $categoryId = (int) $_ENV['CATEGORY_ID'];

        $sth->bindParam(Holder::CATEGORY_ID,
            $categoryId,
            \PDO::PARAM_INT);
        $sth->bindParam(Holder::CATEGORY_NAME,
            $_ENV['CATEGORY_NAME']);

        Statement::execute($sth);

        return $sth->rowCount() !== 0;
    }

    /**
     * @param string $account Аккаунт
     * @param string $sum Размер платежа
     * @param string $payId Номер платежа
     * @return bool Результат добавления платежа
     */
    public static function addPayment(string $account,
                                      string $sum,
                                      string $payId): bool
    {
        $sth = Statement::prepare(Sql::ADD_PAYMENT);

        $categoryId = (int) $_ENV['CATEGORY_ID'];

        $sth->bindParam(Holder::PAY_ID, $payId);
        $sth->bindParam(Holder::CATEGORY_ID,
            $categoryId,
            \PDO::PARAM_INT);
        $sth->bindParam(Holder::PAYMENT_COMMENT,
            $_ENV['PAYMENT_COMMENT']);
        $sth->bindParam(Holder::ACCOUNT, $account);
        $sth->bindParam(Holder::SUM, $sum);
        $sth->bindParam(Holder::PAY_ID, $payId);

        Statement::execute($sth);

        return $sth->rowCount() !== 0;
    }

    /**
     * @param string $payId Номер платежа
     * @return bool Результат подготовления платежа
     */
    public static function setPayment(string $payId): bool
    {
        $sth = Statement::prepare(Sql::SET_PAYMENT);

        $sth->bindParam(Holder::PAY_ID, $payId);

        Statement::execute($sth);

        return $sth->rowCount() !== 0;
    }
}
