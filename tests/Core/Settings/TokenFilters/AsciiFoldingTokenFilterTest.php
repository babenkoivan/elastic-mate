<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AsciiFoldingTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class AsciiFoldingTokenFilterTest extends TestCase
{
    public function test_ascii_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new AsciiFoldingTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_ASCII_FOLDING,
                'preserve_original' => false
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_ascii_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new AsciiFoldingTokenFilter('foo'))->setPreserveOriginal(true);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_ASCII_FOLDING,
                'preserve_original' => true
            ],
            $tokenFilter->toArray()
        );
    }
}
