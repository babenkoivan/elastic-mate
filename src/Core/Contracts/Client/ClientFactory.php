<?php
declare(strict_types = 1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Client;

interface ClientFactory
{
    /**
     * @param array $config
     * @return Client
     */
    public static function fromConfig(array $config): Client;
}
