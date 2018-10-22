<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\PatternCaptureTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class PatternCaptureTokenFilterTest extends TestCase
{
    public function test_pattern_capture_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new PatternCaptureTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_PATTERN_CAPTURE,
                'preserve_original' => false,
                'patterns' => []
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_pattern_capture_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new PatternCaptureTokenFilter('foo'))
            ->setPreserveOriginal(true)
            ->addPattern('(\\p{Ll}+|\\p{Lu}\\p{Ll}+|\\p{Lu}+)')
            ->addPattern('(\\d+)');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_PATTERN_CAPTURE,
                'preserve_original' => true,
                'patterns' => [
                    '(\\p{Ll}+|\\p{Lu}\\p{Ll}+|\\p{Lu}+)',
                    '(\\d+)'
                ]
            ],
            $tokenFilter->toArray()
        );
    }
}
