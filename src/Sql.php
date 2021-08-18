<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Sql
 * @package Panda\MikBill\Chelinvest\GorodApi
 * SQL-запросы
 */
class Sql
{
    /**
     * Получение аккаунта
     */
    public const GET_ACCOUNT = "
        SELECT
            `users`.`user` AS
                `" . Field::ACCOUNT . "`,
            ROUND(
                `users`.`deposit`,
                2
            ) AS
                `" . Field::BALANCE . "`,
            CONCAT(
                SUBSTRING(
                    @surname :=
                    (
                        SUBSTRING(
                            `users`.`fio`,
                            1,
                            (
                                LOCATE(
                                    ' ',
                                    `users`.`fio`
                                ) - 1
                            )
                        )
                    ),
                    1,
                    1
                ),
                REPEAT(
                    '*', 
                    (
                        LENGTH(
                            @surname
                        ) - 1
                    )
                ),
                ' ',
                SUBSTRING(
                    @name :=
                    (
                        SUBSTRING(
                            @name :=
                            (
                                SUBSTRING(
                                    `users`.`fio`,
                                    @locate :=
                                    (
                                        LOCATE(
                                            ' ',
                                            SUBSTRING(
                                                `users`.`fio`,
                                                1,
                                                (
                                                    LOCATE(
                                                        ' ',
                                                        `users`.`fio`
                                                    ) + 1
                                                )
                                            )
                                        ) + 1
                                    )
                                )
                            ),
                            1,
                            IF(
                                0 != @lengthName :=
                                (
                                    LENGTH(
                                        SUBSTRING(
                                            @name,
                                            1,
                                            (
                                                LOCATE(
                                                    ' ',
                                                    @name
                                                ) - 1
                                            )
                                        )
                                    )
                                ),
                                @lengthName,
                                LENGTH(@name)
                            )
                        )
                    ),
                    1,
                    1
                ),
                REPEAT(
                    '*',
                    (
                        LENGTH(
                            @name
                        ) - 1
                    )
                ),
                IF(
                    @name != @middleName :=
                    (
                        SUBSTRING(
                            SUBSTRING(
                                `users`.`fio`,
                                @locate
                            ),
                            (
                                LOCATE(
                                    ' ',
                                    SUBSTRING(
                                        `users`.`fio`,
                                        @locate
                                    )
                                ) + 1
                            )
                        )
                    ),
                    CONCAT(
                        ' ',
                        SUBSTRING(
                            @middleName,
                            1,
                            1
                        ),
                        REPEAT(
                            '*',
                            (
                                LENGTH(
                                    @middleName
                                ) - 1
                            )
                        )
                    ),
                    ''
                )
            ) AS
                `" . Field::CLIENT . "`,
            CONCAT(
                IF(
                    (
                        `users`.`mob_tel` IS NOT NULL
                            AND
                        `users`.`mob_tel` != ''
                    ),
                    '+',
                    ''
                ),
                LEFT(
                    `users`.`mob_tel`,
                    1
                ),
                REPEAT(
                    '*',
                    (
                        LENGTH(
                            `users`.`mob_tel`
                        ) - 3
                    )
                ),
                RIGHT(
                    `users`.`mob_tel`,
                    2
                )
            ) AS
                `" . Field::CONTACT . "`,
            `users`.`numdogovor` AS
                `" . Field::CONTRACT . "`,
            CONCAT(
                REPLACE(
                    `lanes`.`lane`,
                    '.',
                    ''
                ),
                ', ',
                CASE
                    WHEN
                        `users`.`app` = ''
                    THEN
                        `lanes_houses`.`house`
                    WHEN
                        `users`.`app` != ''
                    THEN
                        CONCAT(
                            `lanes_houses`.`house`,
                            ', ',
                            `users`.`app`
                        )
                END
            ) AS
                `" . Field::ADDRESS . "`,
            (
                CASE
                    WHEN
                        `users`.`state` = 1
                    THEN
                        CASE
                            WHEN
                                `users`.`blocked` = 0
                            THEN
                                'Активен'
                            WHEN
                                `users`.`blocked` = 1
                            THEN
                                'Остановлен'
                        END
                    WHEN
                        `users`.`state` = 2
                    THEN
                        'Заморожен'
                    WHEN
                        `users`.`state` = 3
                    THEN
                        'Заблокирован'
                    WHEN
                        `users`.`state` = 4
                    THEN
                        'Удален'
                END
            ) AS
                `" . Field::STATUS . "`
        FROM
            `users`
        LEFT JOIN
            `lanes_houses`
                ON
                    `lanes_houses`.`houseid` = `users`.`houseid`
        LEFT JOIN
            `lanes`
                ON
                    `lanes`.`laneid` = `lanes_houses`.`laneid`
        WHERE
            `users`.`fio` != ''
                AND
            `users`.`user` = " . Holder::ACCOUNT;

    /**
     * Получение платежа
     */
    public const GET_PAYMENT = "
        SELECT
            IF(
                `addons_pay_api`.`transaction_id` = 0,
                CONCAT(
                    DATE_FORMAT(
                        NOW(),
                        '%y%m'
                    ),
                    `addons_pay_api`.`record_id`
                ),
                `addons_pay_api`.`transaction_id`
            ) AS
                `" . Field::PLAT_ID . "`,
            DATE_FORMAT(
                `addons_pay_api`.`creation_time`,
                '%Y-%m-%dT%T'
            ) AS 
                `" . Field::DATE . "`,
            `addons_pay_api`.`status` AS
                `" . Field::STATUS . "`
        FROM
            `addons_pay_api`
        WHERE
            `addons_pay_api`.`category` = " . Holder::CATEGORY_ID . "
                AND
            `addons_pay_api`.`misc_id` = " . Holder::PAY_ID;

    /**
     * Проверка категории платежа
     */
    public const CHECK_CATEGORY = "
        SELECT
            `addons_pay_api_category`.`category`
        FROM
            `addons_pay_api_category`
        WHERE
            `addons_pay_api_category`.`category` = " . Holder::CATEGORY_ID;

    /**
     * Добавление категории платежа
     */
    public const ADD_CATEGORY = "
        INSERT INTO 
            `addons_pay_api_category` (
                `category`,
                `categoryname`
            )
        VALUES (
            " . Holder::CATEGORY_ID . ",
            " . Holder::CATEGORY_NAME . "
        )";

    /**
     * Добавление платежа
     */
    public const ADD_PAYMENT = "
        INSERT INTO
            `addons_pay_api` (
                `misc_id`,
                `category`,
                `user_ref`,
                `amount`,
                `creation_time`,
                `update_time`,
                `comment`
            )
        VALUES (
            " . Holder::PAY_ID . ",
            " . Holder::CATEGORY_ID . ",
            (
                SELECT
                    `users`.`uid`
                FROM
                    `users`
                WHERE
                    `users`.`user` = " . Holder::ACCOUNT . "
            ),
            " . Holder::SUM . " / 100,
            NOW(),
            NOW(),
            " . Holder::PAYMENT_COMMENT . "
        )";

    /**
     * Подготовление платежа
     */
    public const SET_PAYMENT = "
        UPDATE
            `addons_pay_api`
        SET
            `addons_pay_api`.`transaction_id`
                =
            CONCAT(
                DATE_FORMAT(
                    NOW(),
                    '%y%m'
                ),
                `addons_pay_api`.`record_id`
            )
        WHERE
            `addons_pay_api`.`misc_id`= " . Holder::PAY_ID;
}
