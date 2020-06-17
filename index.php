<?php

define ('CONFIG', '../../app/etc/config.xml');

require_once '../../../../../mikbill/__ext/mikbill-chelinvest-gorod-php-api/autoload.php';

use Panda\MikBill\Chelinvest\GorodAPI\Content;
use Panda\MikBill\Chelinvest\GorodAPI\Logic;
use Panda\MikBill\Chelinvest\GorodAPI\Status;
use Panda\MikBill\Chelinvest\GorodAPI\Response;
use Panda\MikBill\Chelinvest\GorodAPI\Code;
use Panda\MikBill\Chelinvest\GorodAPI\Exception\DebugException;

header(Content::XML_TYPE);

$logic = new Logic;

try {
    $logic->run();

    header($logic->getStatus());
    print_r($logic->getContent());
} catch (DebugException $e) {
    header(Status::INTERNAL_500);
    print_r(Response::getError(Code::DEBUG,
        $e->getMessage()));
}
