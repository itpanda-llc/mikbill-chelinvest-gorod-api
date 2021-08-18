<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

declare(strict_types=1);

namespace Panda\MikBill\Chelinvest\GorodApi;

/**
 * Class Logic
 * @package Panda\MikBill\Chelinvest\GorodApi
 * Проверка запроса и формирование ответа
 */
class Logic
{
    /**
     * @var string|null Логин
     */
    private $login;

    /**
     * @var string|null Пароль
     */
    private $password;

    /**
     * @var string|null Метод запроса
     */
    private $method;

    /**
     * @var string|null Аккаунт
     */
    private $account;

    /**
     * @var string|null Номер услуги
     */
    private $service;

    /**
     * @var string|null Размер платежа
     */
    private $sum;

    /**
     * @var string|null Номер платежа
     */
    private $payId;

    /**
     * @var string Заголовок (HTTP-статус)
     */
    public $status = Status::OK_200;

    /**
     * @var string|null Контент
     */
    public $content;

    public function __construct()
    {
        $this->login = $_REQUEST[Param::LOGIN] ?? null;
        $this->password = $_REQUEST[Param::PASSWORD] ?? null;
        $this->method = $_REQUEST[Param::METHOD] ?? null;
        $this->account = $_REQUEST[Param::ACCOUNT] ?? null;
        $this->service = $_REQUEST[Param::SERVICE] ?? null;
        $this->sum = $_REQUEST[Param::SUM] ?? null;
        $this->payId = $_REQUEST[Param::PAY_ID] ?? null;
    }

    public function run(): void
    {
        if (($this->login !== $_ENV['AUTH_LOGIN'])
            || ($this->password !== $_ENV['AUTH_PASSWORD']))
        {
            $this->status = Status::FORBIDDEN_403;
            $this->content = Response::getError(Code::ERROR,
                Message::REQUEST_ERROR);

             return;
        }

        try {
            $methods = (new \ReflectionClass(Method::class))->getConstants();
        } catch (\ReflectionException $e) {
            throw new Exception\DebugException($e->getMessage());
        }

        if (!in_array($this->method, $methods, true)) {
            $this->status = Status::BAD_REQUEST_400;
            $this->content = Response::getError(Code::ERROR,
                Message::REQUEST_ERROR);

            return;
        }

        if ($this->service !== $_ENV['SERVICE_ID']) {
            $this->status = Status::BAD_REQUEST_400;
            $this->content = Response::getError(Code::ERROR,
                Message::REQUEST_ERROR);

            return;
        }

        if ($this->method === Method::CHECK) {
            if ((is_null($this->account)) || (is_null($this->sum))) {
                $this->status = Status::BAD_REQUEST_400;
                $this->content = Response::getError(Code::ERROR,
                    Message::REQUEST_ERROR);

                return;
            }

            $this->content =
                (!is_null($account = Query::getAccount($this->account)))
                    ? Response::getAccount($account)
                    : Response::getError(Code::ERROR,
                        Message::SEARCH_ACCOUNT_ERROR);

            return;
        }

        if ($this->method === Method::PAY) {
            if ((is_null($this->account)) || (is_null($this->sum))
                || (is_null($this->payId)))
            {
                $this->status = Status::BAD_REQUEST_400;
                $this->content = Response::getError(Code::ERROR,
                    Message::REQUEST_ERROR);

                return;
            }

            if (!is_null($payment = Query::getPayment($this->payId))) {
                $this->content = Response::getPayment($payment,
                    Process::getCode($payment[Field::STATUS]));

                return;
            }

            if (is_null(Query::getAccount($this->account))) {
                $this->status = Status::BAD_REQUEST_400;
                $this->content = Response::getError(Code::ERROR,
                    Message::SEARCH_ACCOUNT_ERROR);

                return;
            }

            if ((!Query::checkCategory()) && (!Query::addCategory())) {
                $this->status = Status::INTERNAL_500;
                $this->content = Response::getError(Code::ERROR,
                    Message::SERVER_ERROR);

                return;
            }

            Transaction::begin();

            if ((!Query::addPayment($this->account, $this->sum, $this->payId))
                || (!Query::setPayment($this->payId)))
            {
                Transaction::rollBack();

                $this->status = Status::INTERNAL_500;
                $this->content = Response::getError(Code::ERROR,
                    Message::SERVER_ERROR);

                return;
            }

            Transaction::commit();

            if (!is_null($payment = Query::getPayment($this->payId))) {
                $this->content = Response::getPayment($payment,
                    Process::getCode($payment[Field::STATUS]));

                return;
            }
        }
    }
}
