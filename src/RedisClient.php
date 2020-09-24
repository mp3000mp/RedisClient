<?php

declare(strict_types=1);

namespace mp3000mp\RedisClient;

use Redis;

/**
 * Class RedisClient.
 */
class RedisClient
{
    /**
     * @var Redis
     */
    private $client;

    /**
     * RedisClient constructor.
     *
     * @throws RedisClientException
     */
    public function __construct(string $host = 'localhost', int $port = 6379, ?string $auth = null)
    {
        // test extension
        if (!extension_loaded('redis')) {
            throw new RedisClientException('Redis extension missing', 1000);
        }

        // try to connect
        $this->client = new Redis();
        try {
            $this->client->connect($host, $port);
        } catch (\RedisException $e) {
            throw new RedisClientException($e->getMessage(), 2001);
        }
        if (null !== $auth) {
            $this->client->auth($auth);
        }

        // test connection
        if (!$this->client->isConnected()) {
            throw new RedisClientException('Connection failed', 2002);
        }
    }

    /**
     * get value from Redis
     * if $isJson=true, try to convert retrieved data to json.
     *
     * @return mixed|bool|string
     *
     * @throws RedisClientException
     */
    public function get(string $key, bool $isJson = true)
    {
        $r = $this->client->get($key);

        if (false !== $r && $isJson) {
            $r = json_decode($r, true);
            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new RedisClientException('Json conversion failed: '.json_last_error_msg(), 3000);
            }
        }

        return $r;
    }

    /**
     * set value to Redis.
     * optional $timeout in seconds.
     *
     * @param mixed $value
     */
    public function set(string $key, $value, ?int $timeout = null): void
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }

        if (null === $timeout) {
            $this->client->set($key, $value);
        } else {
            $this->client->setex($key, $timeout, $value);
        }
    }

    /**
     * get last Redis error msg.
     */
    public function getLastError(): ?string
    {
        return $this->client->getLastError();
    }

    /**
     * close Redis connection.
     */
    public function close(): void
    {
        $this->client->close();
    }

    /**
     * delete Redis key.
     */
    public function delete(string $key): void
    {
        $this->client->del($key);
    }
}
