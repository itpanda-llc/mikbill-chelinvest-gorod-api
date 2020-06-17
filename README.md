# MikBill-Chelinvest-Gorod-PHP-API

API для биллинговой системы [АСР "MikBill"](https://mikbill.pro), позволящий осуществлять прием платежей через платежную систему ["Система город: Челябинкая область"](https://gorod74.ru), функционирующую на финансовой и технологической платформе [ПАО "Челябинвестбанка"](https://chelinvest.ru)

[![GitHub license](https://img.shields.io/badge/license-MIT-blue)](LICENSE)

## Ссылки

* [Разработка](https://github.com/itpanda-llc)
* [О проекте (АСР "MikBill")](https://mikbill.pro)
* [Документация (АСР "MikBill")](https://wiki.mikbill.pro)
* [Сообщество (АСР "MikBill")](https://mikbill.userecho.com)
* [О проекте ("Система город: Челябинкая область")](https://gorod74.ru)
* [Документация (cм. п.3.3 и далее) "Система город: Челябинкая область"](%D0%A2%D0%B5%D1%85%D0%BD%D0%B8%D1%87%D0%B5%D1%81%D0%BA%D0%BE%D0%B5%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%20v1.3.doc)
* [О проекте (ПАО "Челябинвестбанк")](https://chelinvest.ru)

## Возможности

* Формирование статуса ответа и контента
* Проверка параметров запроса
* Проверка и вывод информации об аккаунте и платеже
* Добавление категории платежа
* Проведение платежа и вывод информации о платеже

## Требования

* PHP >= 7.2
* PDO
* SimpleXML

## Установка

```shell script
php composer.phar require "itpanda-llc/mikbill-chelinvest-gorod-php-api"
```

или

```shell script
git clone https://github.com/itpanda-llc/mikbill-chelinvest-gorod-php-api
```

## Конфигурация и начало пользования

##### Указание параметров в некоторых файлах

1. Параметры аутентификации - ["src/Auth.php"](src/Auth.php) (информация банка)
2. Параметры услуги - ["src/Service.php"](src/Service.php) (информация банка)
2. Параметры платежа - ["src/Payment.php"](src/Payment.php)

##### Создание индексного файла, например "index.php" (или использование файла из репозитория, с откорректированными указателями на файлы), в требуемом каталоге, для веб-сервера

```php
<?php

/*
 * Актуально для ОС "CentOS".
 * Возможно не изменять указатели на файлы, при условии размещения файла с этим кодом (файла из репозитория)
 * в директории по адресу "/var/www/mikbill/admin/process/имя директории, например "gorod"/",
 * а содержимого репозитория в директории по адресу "/var/mikbill/__ext/mikbill-chelinvest-gorod-php-api/".
 */

// Определение файла конфигурации АСР "MikBill"
define ('CONFIG', '../../app/etc/config.xml');

// Подключение инструмента
require_once '../../../../../mikbill/__ext/mikbill-chelinvest-gorod-php-api/autoload.php';

// Импорт составляющих
use Panda\MikBill\Chelinvest\GorodAPI\Content;
use Panda\MikBill\Chelinvest\GorodAPI\Logic;
use Panda\MikBill\Chelinvest\GorodAPI\Status;
use Panda\MikBill\Chelinvest\GorodAPI\Response;
use Panda\MikBill\Chelinvest\GorodAPI\Exception\DebugException;

// Отправка заголовка (тип контента)
header(Content::XML_TYPE);

// Запуск приложения
$logic = new Logic;

try {
    // Обработка запроса
    $logic->run();

    // Отправка заголовка (HTTP-статус)
    header($logic->getStatus());

    // Вывод контента
    print_r($logic->getContent());
} catch (DebugException $e) {
    // Отправка заголовка (HTTP-статус - "500 Internal")
    header(Status::INTERNAL_500);

    // Вывод контента (сообщение об ошибке)
    print_r(Response::getDebug($e->getMessage()));
}
```

## Примеры ответов интерфейса

Проверка аккаунта

```xml
<?xml version="1.0" encoding="windows-1251"?>
<Answer>
    <Code>0</Code>
    <Client>М*********** И***** Р*******</Client>
    <Account>0112</Account>
    <Balance>0.00</Balance>
    <Status>Активен</Status>
    <Service>Домашний интернет</Service>
    <Address>8 Марта ул, 25</Address>
    <Contract>СВ-ИТ0112</Contract>
    <Contact>+7********34</Contact>
</Answer>
```

Проверка и проведение платежа

```xml
<?xml version="1.0" encoding="windows-1251"?>
<Answer>
    <Code>0</Code>
    <PlatID>191120</PlatID>
    <Status>0</Status>
    <Date>2019/11/16 14:02:10</Date>
</Answer>
```

Сообщения об ошибках

```xml
<?xml version="1.0" encoding="windows-1251"?>
<Answer>
    <Code>100</Code>
    <Message>Клиент не найден</Message>
</Answer>
```

```xml
<?xml version="1.0" encoding="windows-1251"?>
<Answer>
    <Code>101</Code>
    <Message>Авторизация не выполнена</Message>
</Answer>
```

```xml
<?xml version="1.0" encoding="windows-1251"?>
<Answer>
    <Code>102</Code>
    <Message>Неправильный запрос</Message>
</Answer>
```

```xml
<?xml version="1.0" encoding="windows-1251"?>
<Answer>
    <Code>103</Code>
    <Message>Платеж не принят</Message>
</Answer>
```

```xml
<?xml version="1.0" encoding="windows-1251"?>
<Answer>
    <Code>104</Code>
    <Message>Ошибка сервера</Message>
</Answer>
```

```xml
<?xml version="1.0" encoding="windows-1251"?>
<Answer>
    <Code>110</Code>
    <Message>String could not be parsed as XML</Message>
</Answer>
```
