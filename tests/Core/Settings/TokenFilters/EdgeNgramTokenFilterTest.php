<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\EdgeNgramTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class EdgeNgramTokenFilterTest extends TestCase
{
    public function test_edge_ngram_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new EdgeNgramTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_EDGE_NGRAM,
                'min_gram' => 1,
                'max_gram' => 2
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_edge_ngram_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new EdgeNgramTokenFilter('foo'))
            ->setMinGram(3)
            ->setMaxGram(8);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_EDGE_NGRAM,
                'min_gram' => 3,
                'max_gram' => 8
            ],
            $tokenFilter->toArray()
        );
    }
}
