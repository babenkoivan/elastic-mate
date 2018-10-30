<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Blocks
 */
final class BlocksTest extends TestCase
{
    public function test_blocks_has_correct_default_values(): void
    {
        $blocks = new Blocks();

        $this->assertSame(
            [
                'read_only' => false,
                'read_only_allow_delete' => false,
                'read' => false,
                'write' => false,
                'metadata' => false
            ],
            $blocks->toArray()
        );
    }

    public function test_blocks_can_be_converted_to_array(): void
    {
        $blocks = (new Blocks())
            ->setReadOnly(true)
            ->setReadOnlyAllowDelete(true)
            ->setRead(true)
            ->setWrite(true)
            ->setMetadata(true);

        $this->assertSame(
            [
                'read_only' => true,
                'read_only_allow_delete' => true,
                'read' => true,
                'write' => true,
                'metadata' => true
            ],
            $blocks->toArray()
        );
    }
}
