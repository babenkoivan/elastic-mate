<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\ShingleTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class ShingleTokenFilterTest extends TestCase
{
    public function test_shingle_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new ShingleTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_SHINGLE,
                'max_shingle_size' => 2,
                'min_shingle_size' => 2,
                'output_unigrams' => true,
                'output_unigrams_if_no_shingles' => false,
                'token_separator' => ' ',
                'filler_token' => '_'
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_shingle_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new ShingleTokenFilter('foo'))
            ->setMaxShingleSize(4)
            ->setMinShingleSize(3)
            ->setOutputUnigrams(false)
            ->setOutputUnigramsIfNoShingles(true)
            ->setTokenSeparator('-')
            ->setFillerToken('|');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_SHINGLE,
                'max_shingle_size' => 4,
                'min_shingle_size' => 3,
                'output_unigrams' => false,
                'output_unigrams_if_no_shingles' => true,
                'token_separator' => '-',
                'filler_token' => '|'
            ],
            $tokenFilter->toArray()
        );
    }
}
