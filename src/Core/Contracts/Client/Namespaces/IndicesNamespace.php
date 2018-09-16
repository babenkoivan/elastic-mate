<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Client\Namespaces;

interface IndicesNamespace
{
    /**
     * @param array $params
     * @return bool
     */
    public function exists(array $params): bool;

    /**
     * @param array $params
     * @return array
     */
    public function create(array $params): array;

    /**
     * @param array $params
     * @return array
     */
    public function delete(array $params): array;

    /**
     * @param array $params
     * @return array
     */
    public function putSettings(array $params): array;

    /**
     * @param array $params
     * @return array
     */
    public function getSettings(array $params): array;

    /**
     * @param array $params
     * @return array
     */
    public function putMapping(array $params): array;

    /**
     * @param array $params
     * @return array
     */
    public function getMapping(array $params): array;

    /**
     * @param array $params
     * @return array
     */
    public function open(array $params): array;

    /**
     * @param array $params
     * @return array
     */
    public function close(array $params): array;
}
