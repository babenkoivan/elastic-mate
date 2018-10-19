<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\MultiplexerTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class MultiplexerTokenFilterTest extends TestCase
{
    public function test_multiplexer_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new MultiplexerTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_MULTIPLEXER,
                'preserve_original' => true
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_multiplexer_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new MultiplexerTokenFilter('foo'))
            ->setPreserveOriginal(false)
            ->addFilter(TokenFilter::TYPE_LOWER_CASE)
            ->addFilter(TokenFilter::TYPE_PORTER_STEM);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_MULTIPLEXER,
                'preserve_original' => false,
                'filters' => [
                    TokenFilter::TYPE_LOWER_CASE,
                    TokenFilter::TYPE_PORTER_STEM
                ]
            ],
            $tokenFilter->toArray()
        );
    }
}
