# RedisClient
 Simple class easy to use that wraps Redis extension.
 
 Table of Contents
 -----------------
 
  - [Installation](#installation)
  - [Usage](#usage)


Installation
------------

```sh
composer require mp3000mp/RedisClient
```


Usage
-----

```php
// This will create window.ListFilter
$client = new RedisClient($host, $port, $auth);

// simple get set system
$client->set('key', 'value');
$val = $client->get('key');

// this value will be converted into json text into redis
$client->set('key_array', ['test' => 'test']);
// returns '{"test":"test"}'
$client->get('key_array');
// returns ['test' => 'test']
$client->get('key_array', true);

// this key will live 120 seconds
$client->set('key', 'test', 120); 
$client->delete('key');

// close connection
$client->close();

```



