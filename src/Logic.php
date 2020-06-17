<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-PHP-API
 * @link https://github.com/itpanda-llc
 */

namespace Panda\MikBill\Chelinvest\GorodAPI;

use Panda\MikBill\Chelinvest\GorodAPI\Exception\DebugException;

/**
 * Class Logic
 * @package Panda\MikBill\Chelinvest\GorodAPI
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
    private $status = Status::BAD_REQUEST_400;

    /**
     * @var string|null Контент
     */
    private $content;

    /**
     * Logic constructor.
     * Подготовка к обработке запроса
     */
	public function __construct()
	{
        $query = (empty($_GET)) ? $_POST : $_GET;

		$this->login = (!empty($query[Param::LOGIN]))
            ? $query[Param::LOGIN]
            : null;
		$this->password = (!empty($query[Param::PASSWORD]))
            ? $query[Param::PASSWORD]
            : null;
		$this->method = (!empty($query[Param::METHOD]))
            ? $query[Param::METHOD]
            : null;
		$this->account = (!empty($query[Param::ACCOUNT]))
            ? $query[Param::ACCOUNT]
            : null;
		$this->service = (!empty($query[Param::SERVICE]))
            ? $query[Param::SERVICE]
            : null;
		$this->sum = (!empty($query[Param::SUM]))
            ? $query[Param::SUM]
            : null;
		$this->payId = (!empty($query[Param::PAY_ID]))
            ? $query[Param::PAY_ID]
            : null;
	}

    /**
     * Проверка параметров запроса и формирование контента
     */
    public function run(): void
    {
        if (($this->login !== Auth::LOGIN)
            || ($this->password !== Auth::PASSWORD))
        {
            $this->content = Response::getError(Code::ERROR,
                Message::REQUEST_ERROR);

             return;
        }

        try {
            $methods = (new \ReflectionClass(Method::class))->getConstants();
        } catch (\ReflectionException $e) {
            throw new DebugException($e->getMessage());
        }

        if (!in_array($this->method, $methods, true)) {
            $this->content = Response::getError(Code::ERROR,
                Message::REQUEST_ERROR);

            return;
        }

        if ($this->service !== Service::ID) {
            $this->content = Response::getError(Code::ERROR,
                Message::REQUEST_ERROR);

            return;
        }

        if ((is_null($this->account)) || (is_null($this->sum))
            || (($this->method === Method::PAY) && (is_null($this->payId))))
        {
            $this->content = Response::getError(Code::ERROR,
                Message::REQUEST_ERROR);

            return;
        }

        if ($this->method === Method::CHECK) {
            $this->status = Status::OK_200;

            if (!is_null($account = Query::getAccount($this->account))) {
                $this->content = Response::getAccount($account);
            } else {
                $this->content = Response::getError(Code::ERROR,
                    Message::ACCOUNT_ERROR);
            }

            return;
        }

        if ($this->method === Method::PAY) {
            if (!is_null($payment = Query::getPayment($this->payId))) {
                $this->status = Status::OK_200;
                $this->content = Response::getPayment($payment);

                return;
            }

            if (is_null(Query::getAccount($this->account))) {
                $this->content = Response::getError(Code::ERROR,
                    Message::ACCOUNT_ERROR);

                return;
            }

            if ((!Query::checkCategory()) && (!Query::addCategory()))
                throw new DebugException(Message::PAYMENT_ERROR);

            if ((!Query::addPayment($this->account, $this->sum, $this->payId))
                || (!Query::setPayment($this->payId)))
            {
                throw new DebugException(Message::PAYMENT_ERROR);
            }

            if (!is_null($payment = Query::getPayment($this->payId))) {
                $this->status = Status::OK_200;
                $this->content = Response::getPayment($payment);

                return;
            }

            throw new DebugException(Message::PAYMENT_ERROR);
        }
    }

    /**
     * @return string Заголовок (HTTP-статус)
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string Контент
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
