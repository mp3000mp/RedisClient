# RedisClient
 Simple class easy to use that wraps Redis extension without dependencies.

 ![Packagist Version](https://img.shields.io/packagist/v/mp3000mp/redis-client?color=%230273b3) 
 [![Build Status](https://travis-ci.org/mp3000mp/RedisClient.svg?branch=master)](https://travis-ci.org/mp3000mp/RedisClient)
 [![Coverage Status](https://coveralls.io/repos/github/mp3000mp/RedisClient/badge.svg?branch=master)](https://coveralls.io/github/mp3000mp/RedisClient?branch=master)
 [![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
 
 Table of Contents
 -----------------
 
  - [Installation](#installation)
  - [Usage](#usage)
  - [Use with Symfony](#symfony)


Installation
------------

```sh
composer require mp3000mp/RedisClient
```


Usage
-----

```php
// This will try to connect and throw a RedisClientException if connection failed
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

Use with Symfony
-----

Add this to services.yml
```yml

    mp3000mp\RedisClient\RedisClient:
        arguments: ['%env(REDIS_HOST)%', '%env(REDIS_PORT)%', '%env(REDIS_AUTH)%']

```
