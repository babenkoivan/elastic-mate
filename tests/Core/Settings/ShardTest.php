<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Shard
 */
final class ShardTest extends TestCase
{
    public function test_shard_has_correct_default_values(): void
    {
        $shard = new Shard();

        $this->assertSame(
            [
                'check_on_startup' => Shard::CHECK_ON_STARTUP_FALSE
            ],
            $shard->toArray()
        );
    }

    public function test_shard_can_be_converted_to_array(): void
    {
        $shard = (new Shard())->setCheckOnStartup(Shard::CHECK_ON_STARTUP_FIX);

        $this->assertSame(
            [
                'check_on_startup' => Shard::CHECK_ON_STARTUP_FIX
            ],
            $shard->toArray()
        );
    }
}
