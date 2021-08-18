<?php

/**
 * Файл из репозитория MikBill-Chelinvest-Gorod-API
 * @link https://github.com/itpanda-llc/mikbill-chelinvest-gorod-api
 */

declare(strict_types=1);

require_once '/var/mikbill/__ext/vendor/autoload.php';

use Panda\MikBill\Chelinvest\GorodApi;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(
    '/var/mikbill/__ext/vendor/itpanda-llc/mikbill-chelinvest-gorod-api/');

try {
    $dotenv->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    header(GorodApi\Status::INTERNAL_500);
    print_r(GorodApi\Response::getError(GorodApi\Code::ERROR,
        $e->getMessage()));
}

header(sprintf("%s; charset=%s",
    GorodApi\Content::TEXT_XML,
    $_ENV['RESPONSE_CHARSET']));

$logic = new GorodApi\Logic;

try {
    $logic->run();

    header($logic->status);
    print_r($logic->content);
} catch (GorodApi\Exception\SystemException
    | GorodApi\Exception\DebugException $e) {
    header(GorodApi\Status::INTERNAL_500);
    print_r(GorodApi\Response::getError(GorodApi\Code::ERROR,
        $e->getMessage()));
}
