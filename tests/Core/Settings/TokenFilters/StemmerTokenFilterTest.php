<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\StemmerTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class StemmerTokenFilterTest extends TestCase
{
    public function test_stemmer_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new StemmerTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_STEMMER,
                'name' => Analysis::LANGUAGE_ENGLISH
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_stemmer_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new StemmerTokenFilter('foo'))->setLanguage(Analysis::LANGUAGE_LIGHT_ENGLISH);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_STEMMER,
                'name' => Analysis::LANGUAGE_LIGHT_ENGLISH
            ],
            $tokenFilter->toArray()
        );
    }
}
