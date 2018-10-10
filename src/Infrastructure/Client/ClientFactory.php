<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Infrastructure\Client;

use BabenkoIvan\ElasticMate\Core\Contracts\Client\Client as ClientContract;
use BabenkoIvan\ElasticMate\Core\Contracts\Client\ClientFactory as ClientFactoryContract;
use Elasticsearch\ClientBuilder;

final class ClientFactory implements ClientFactoryContract
{
    /**
     * @inheritdoc
     */
    public static function fromConfig(array $config): ClientContract
    {
        $adapteeClient = ClientBuilder::fromConfig($config);
        return new Client($adapteeClient);
    }
}
