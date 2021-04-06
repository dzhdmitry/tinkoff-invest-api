# PHP-клиент для API Тинькофф Инвестиций

[![Code Coverage](https://codecov.io/gh/dzhdmitry/tinkoff-invest-api/branch/master/graph/badge.svg)](https://codecov.io/gh/dzhdmitry/tinkoff-invest-api)

Позволяет делать запросы к [OpenAPI](https://tinkoffcreditsystems.github.io/invest-openapi/) сервиса Тинькофф Инвестиции на языке PHP.
Формат данных, получаемых по REST API, полностью соответствует схеме, указанной в документации для REST API.

В клиенте реализованы следующие методы [REST API](https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/):

* sandbox
  * &#10004; POST /sandbox/register
  * &#10004; POST /sandbox/currencies/balance
  * &#10006; POST /sandbox/positions/balance
  * &#10006; POST /sandbox/remove
  * &#10006; POST /sandbox/clear
* orders
  * &#10004; GET /orders
  * &#10004; POST /orders/limit-order
  * &#10004; POST /orders/market-order
  * &#10004; POST /orders/cancel
* portfolio
  * &#10004; GET /portfolio
  * &#10004; GET /portfolio/currencies
* market
  * &#10004; GET /market/stocks
  * &#10004; GET /market/bonds
  * &#10004; GET /market/etfs
  * &#10004; GET /market/currencies
  * &#10004; GET /market/orderbook
  * &#10004; GET /market/candles
  * &#10004; GET /market/search/by-figi
  * &#10004; GET /market/search/by-ticker
* operations
  * &#10004; GET /operations
* user
  * &#10004; GET /user/accounts

## Требования

- PHP 7.4+
- Composer

## Установка

1. Установить клиент:
```bash
composer require dzhdmitry/tinkoff-invest-api
```

2. Выполнить [авторизацию](https://tinkoffcreditsystems.github.io/invest-openapi/auth/), выпустить токены OpenAPI для биржи и Sandbox

## Использование

```php
use Dzhdmitry\TinkoffSandbox\TinkoffInvest;

// Создать клиент с токеном
$client = TinkoffInvest::create('YOUR_TRADE_TOKEN');

// Пример 1. Получение списка акций
$stocksResponse = $client->market()->getStocks();

foreach ($stocksResponse->getPayload()->getInstruments() as $instrument) {
    echo $instrument->getTicker() . "\n";
    echo $instrument->getName() . "\n";
    echo $instrument->getCurrency() . "\n";
}

// Пример 2. Получение портфеля клиента (потребуется ID брокерского счета)
$brokerAccountId = 'your-broker-account-id';
$portfolioResponse = $client->portfolio($brokerAccountId)->get();

foreach ($portfolioResponse->getPayload()->getPositions() as $position) {
    echo $position->getInstrumentType() . "\n";
    echo $position->getTicker() . "\n";
    echo $position->getName() . "\n";
    echo $position->getBalance() . "\n";
}
```

## Лицензия

Распространяется под лицензией [MIT](https://raw.githubusercontent.com/dzhdmitry/tinkoff-invest-api/master/LICENSE)
