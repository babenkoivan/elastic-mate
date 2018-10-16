<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\NgramTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class NgramTokenFilterTest extends TestCase
{
    public function test_ngram_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new NgramTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_NGRAM,
                'min_gram' => 1,
                'max_gram' => 2
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_ngram_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new NgramTokenFilter('foo'))
            ->setMinGram(3)
            ->setMaxGram(8);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_NGRAM,
                'min_gram' => 3,
                'max_gram' => 8
            ],
            $tokenFilter->toArray()
        );
    }
}
