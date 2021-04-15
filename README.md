# PHP-клиент для API Тинькофф Инвестиций

[![Code Coverage](https://codecov.io/gh/dzhdmitry/tinkoff-invest-api/branch/master/graph/badge.svg)](https://codecov.io/gh/dzhdmitry/tinkoff-invest-api)

Позволяет делать запросы к [OpenAPI](https://tinkoffcreditsystems.github.io/invest-openapi/) сервиса Тинькофф Инвестиции на языке PHP.
Формат данных, получаемых по REST API, полностью соответствует схеме, указанной в документации для REST API.

В REST-клиенте реализованы следующие методы [REST API](https://tinkoffcreditsystems.github.io/invest-openapi/swagger-ui/):

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

Также реализованы подписки на потоки данных по [streaming протоколу](https://tinkoffcreditsystems.github.io/invest-openapi/marketdata/):

* &#10004; candle
* &#10004; orderbook
* &#10004; instrument_info

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
// Пример 1. Получение списка акций
use Dzhdmitry\TinkoffInvestApi\RestClientFactory;

// Создать клиент с токеном
$client = (new RestClientFactory())->create('YOUR_TRADE_TOKEN');
// Сделать запрос на получение списка акций
$response = $client->market()->getStocks();

foreach ($response->getPayload()->getInstruments() as $instrument) {
    echo $instrument->getTicker() . "\n";
    echo $instrument->getName() . "\n";
    echo $instrument->getCurrency() . "\n";
}
```

```php
// Пример 2. Получение портфеля клиента
use Dzhdmitry\TinkoffInvestApi\RestClientFactory;

// Создать клиент с токеном
$client = (new RestClientFactory())->create('YOUR_TRADE_TOKEN');
$brokerAccountId = 'your-broker-account-id';
// Сделать запрос на получение портфеля клиента по счету $brokerAccountId
$response = $client->portfolio()->get($brokerAccountId);

foreach ($response->getPayload()->getPositions() as $position) {
    echo $position->getInstrumentType() . "\n";
    echo $position->getTicker() . "\n";
    echo $position->getName() . "\n";
    echo $position->getBalance() . "\n";
}
```

```php
// Пример 3. Создание лимитной заявки
use Dzhdmitry\TinkoffInvestApi\RestClientFactory;
use Dzhdmitry\TinkoffInvestApi\Schema\Request\LimitOrderRequest;
use Dzhdmitry\TinkoffInvestApi\Schema\Enum\OperationType;

// Создать клиент с токеном
$client = (new RestClientFactory())->create('YOUR_TRADE_TOKEN');
// Сделать запрос на создание лимитной заявки на счете "Тинькофф" (Заявка на покупку 5 лотов USD по цене 75.20)
$response = $client->orders()->postLimitOrder(
    'BBG0013HGFT4', 
    new LimitOrderRequest(5, OperationType::BUY, 75.20)
);
$order = $response->getPayload();

echo $order->getOrderId() . "\n";
echo $order->getOperation() . "\n";
echo $order->getStatus() . "\n";
echo $order->getRequestedLots() . "\n";
echo $order->getExecutedLots() . "\n";
```

```php
// Пример 4. Протокол Streaming
use Dzhdmitry\TinkoffInvestApi\Streaming\ResponseDeserializerFactory;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload\ErrorPayload;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Payload\Orderbook;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Request\OrderbookRequest;
use Dzhdmitry\TinkoffInvestApi\Streaming\Schema\Response\AbstractResponse;
use Dzhdmitry\TinkoffInvestApi\Streaming\Connection;
use Dzhdmitry\TinkoffInvestApi\Streaming\WebsocketConnectionFactory;

Amp\Loop::run(function () {
    // Объект ResponseDeserializer можно использовать для десериализации ответов сервера
    $deserializer = (new ResponseDeserializerFactory())->create();

    // Connection предоставляет упрощенный доступ к управлению подписками на потоки данных
    $connection = new Connection(yield WebsocketConnectionFactory::create('YOUR_TRADE_TOKEN'));

    // Подписка на информацию биржевой стакан по акциям Apple
    $connection->subscribe(new OrderbookRequest('BBG000B9XRY4', 4));

    $i = 0;

    while ($message = yield $connection->receive()) {
        /** @var Amp\Websocket\Message $message   полученное из WebSocket сообщение */
        /** @var AbstractResponse      $response  десериализованное тело сообщения */
        $response = $deserializer->deserialize(yield $message->buffer());

        echo $response->getEvent() . ' at ' . $response->getTime()->format(DATE_RFC3339) . "\n";

        if ($response->getPayload() instanceof ErrorPayload) {
            echo ' - error: ' . $response->getPayload()->getError() . "\n";
        } elseif ($response->getPayload() instanceof Orderbook) {
            echo ' - figi: ' . $response->getPayload()->getFigi() . "\n";
            echo ' - bids: ' . count($response->getPayload()->getBids()) . "\n";
            echo ' - asks: ' . count($response->getPayload()->getAsks()) . "\n";
        }

        if (++$i >= 4) {
            // Закрыть соединение при получении 4 ответов
            $connection->close();

            break;
        }

        // Получать каждое сообщение с интервалом в 1 сек
        yield Amp\delay(1000);
    }
});
```

## Лицензия

Распространяется под лицензией [MIT](https://raw.githubusercontent.com/dzhdmitry/tinkoff-invest-api/master/LICENSE)
