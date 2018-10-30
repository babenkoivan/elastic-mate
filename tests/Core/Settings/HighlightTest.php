<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Highlight
 */
final class HighlightTest extends TestCase
{
    public function test_highlight_has_correct_default_values(): void
    {
        $highlight = new Highlight();

        $this->assertSame(
            [
                'max_analyzed_offset' => -1
            ],
            $highlight->toArray()
        );
    }

    public function test_highlight_can_be_converted_to_array(): void
    {
        $highlight = (new Highlight())
            ->setMaxAnalyzedOffset(10);

        $this->assertSame(
            [
                'max_analyzed_offset' => 10
            ],
            $highlight->toArray()
        );
    }
}
