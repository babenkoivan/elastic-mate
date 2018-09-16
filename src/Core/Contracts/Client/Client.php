<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Client;

use BabenkoIvan\ElasticMate\Core\Contracts\Client\Namespaces\IndicesNamespace;

interface Client
{
    /**
     * @param array $params
     * @return array
     */
    public function bulk(array $params): array;

    /**
     * @param array $params
     * @return array
     */
    public function search(array $params): array;

    /**
     * @return IndicesNamespace
     */
    public function indices(): IndicesNamespace;
}
