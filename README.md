# MikBill-Chelinvest-Gorod-API

API для для интеграции биллинговой системы ["MikBill"](https://mikbill.pro) с платежной системой ["Город"](https://gorod74.ru) ПАО "Челябинвестбанк"

[![Packagist Downloads](https://img.shields.io/packagist/dt/itpanda-llc/mikbill-chelinvest-gorod-api)](https://packagist.org/packages/itpanda-llc/mikbill-chelinvest-gorod-api/stats)
![Packagist License](https://img.shields.io/packagist/l/itpanda-llc/mikbill-chelinvest-gorod-api)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/itpanda-llc/mikbill-chelinvest-gorod-api)

## Ссылки

* [Разработка](https://github.com/itpanda-llc)
* [О проекте (MikBill)](https://mikbill.pro)
* [О проекте (Город)](https://gorod74.ru)
* [Документация (MikBill)](https://wiki.mikbill.pro)
* [Документация (Город)](%D0%A2%D0%B5%D1%85%D0%BD%D0%B8%D1%87%D0%B5%D1%81%D0%BA%D0%BE%D0%B5%20%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5%20v1.3.doc)

## Возможности

* Запрос возможности зачисления платежа
* Проведение платежа

## Требования

* PHP >= 7.2
* libxml
* PDO
* SimpleXML
* vlucas/phpdotenv ^5.3

## Установка

```shell script
composer require itpanda-llc/mikbill-chelinvest-gorod-api
```

## Конфигурация

* Копирование файла [".env.example"](.env.example) в ".env"

```shell script
copy .env.example .env
```

* Указание параметров в файле ".env"
* Указание путей к интерфейсу в файле ["index.php"](examples/www/mikbill/admin/api/chelinvest/gorod/index.php), предварительно размещенного в каталоге веб-сервера

## Примеры ответов интерфейса

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

```xml
<?xml version="1.0" encoding="windows-1251"?>
<Answer>
    <Code>0</Code>
    <PlatID>1911105</PlatID>
    <Status>1</Status>
    <Date>2019/11/26 12:47:21</Date>
</Answer>
```

```xml
<?xml version="1.0" encoding="windows-1251"?>
<Answer>
    <Code>1</Code>
    <Message>Неправильный запрос</Message>
</Answer>
```

```xml
<?xml version="1.0" encoding="windows-1251"?>
<Answer>
    <Code>1</Code>
    <Message>Аккаунт не найден</Message>
</Answer>
```
