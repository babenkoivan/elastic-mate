<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Routing
 */
final class RoutingTest extends TestCase
{
    public function test_routing_has_correct_default_values(): void
    {
        $routing = new Routing();

        $this->assertSame(
            [
                'allocation' => [
                    'enable' => Routing::ENABLE_ALLOCATION_ALL
                ],
                'rebalance' => [
                    'enable' => Routing::ENABLE_REBALANCE_ALL
                ]
            ],
            $routing->toArray()
        );
    }

    public function test_routing_can_be_converted_to_array(): void
    {
        $routing = (new Routing())
            ->setEnableAllocation(Routing::ENABLE_ALLOCATION_NEW_PRIMARIES)
            ->setEnableRebalance(Routing::ENABLE_REBALANCE_REPLICAS);

        $this->assertSame(
            [
                'allocation' => [
                    'enable' => Routing::ENABLE_ALLOCATION_NEW_PRIMARIES
                ],
                'rebalance' => [
                    'enable' => Routing::ENABLE_REBALANCE_REPLICAS
                ]
            ],
            $routing->toArray()
        );
    }
}
