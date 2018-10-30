<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;

final class Routing implements Arrayable
{
    const ENABLE_ALLOCATION_ALL = 'all';
    const ENABLE_ALLOCATION_PRIMARIES = 'primaries';
    const ENABLE_ALLOCATION_NEW_PRIMARIES = 'new_primaries';
    const ENABLE_ALLOCATION_NONE = 'none';

    const ENABLE_REBALANCE_ALL = 'all';
    const ENABLE_REBALANCE_PRIMARIES = 'primaries';
    const ENABLE_REBALANCE_REPLICAS = 'replicas';
    const ENABLE_REBALANCE_NONE = 'none';

    /**
     * @var string
     */
    private $enableAllocation = self::ENABLE_ALLOCATION_ALL;

    /**
     * @var string
     */
    private $enableRebalance = self::ENABLE_REBALANCE_ALL;

    /**
     * @param string $enableAllocation
     * @return self
     */
    public function enableAllocation(string $enableAllocation): self
    {
        $this->enableAllocation = $enableAllocation;
        return $this;
    }

    /**
     * @param string $enableRebalance
     * @return self
     */
    public function enableRebalance(string $enableRebalance): self
    {
        $this->enableRebalance = $enableRebalance;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'allocation' => [
                'enable' => $this->enableAllocation
            ],
            'rebalance' => [
                'enable' => $this->enableRebalance
            ]
        ];
    }
}
