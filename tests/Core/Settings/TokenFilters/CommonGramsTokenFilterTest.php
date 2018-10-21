<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\CommonGramsTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class CommonGramsTokenFilterTest extends TestCase
{
    public function test_common_grams_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new CommonGramsTokenFilter('foo'))
            ->addCommonWord('a')
            ->addCommonWord('an')
            ->setIgnoreCase(true)
            ->setQueryMode(true);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_COMMON_GRAMS,
                'ignore_case' => true,
                'query_mode' => true,
                'common_words' => ['a', 'an']
            ],
            $tokenFilter->toArray()
        );
    }
}
