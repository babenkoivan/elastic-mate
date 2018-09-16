<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces;

use BabenkoIvan\ElasticMate\Core\Contracts\Client\Namespaces\IndicesNamespace as IndicesNamespaceContract;
use Elasticsearch\Namespaces\IndicesNamespace as AdapteeIndicesNamespace;

class IndicesNamespace implements IndicesNamespaceContract
{
    /**
     * @var AdapteeIndicesNamespace
     */
    private $adapteeIndices;

    /**
     * @param AdapteeIndicesNamespace $adapteeIndicesNamespace
     */
    public function __construct(AdapteeIndicesNamespace $adapteeIndicesNamespace)
    {
        $this->adapteeIndices = $adapteeIndicesNamespace;
    }

    /**
     * @inheritdoc
     */
    public function exists(array $params): bool
    {
        return $this->adapteeIndices
            ->exists($params);
    }

    /**
     * @inheritdoc
     */
    public function create(array $params): array
    {
        return $this->adapteeIndices
            ->create($params);
    }

    /**
     * @inheritdoc
     */
    public function delete(array $params): array
    {
        return $this->adapteeIndices
            ->delete($params);
    }

    /**
     * @inheritdoc
     */
    public function putSettings(array $params): array
    {
        return $this->adapteeIndices
            ->putSettings($params);
    }

    /**
     * @inheritdoc
     */
    public function getSettings(array $params): array
    {
        return $this->adapteeIndices
            ->getSettings($params);
    }

    /**
     * @inheritdoc
     */
    public function putMapping(array $params): array
    {
        return $this->adapteeIndices
            ->putMapping($params);
    }

    /**
     * @inheritdoc
     */
    public function getMapping(array $params): array
    {
        return $this->adapteeIndices
            ->getMapping($params);
    }

    /**
     * @inheritdoc
     */
    public function open(array $params): array
    {
        return $this->adapteeIndices
            ->open($params);
    }

    /**
     * @inheritdoc
     */
    public function close(array $params): array
    {
        return $this->adapteeIndices
            ->close($params);
    }
}
