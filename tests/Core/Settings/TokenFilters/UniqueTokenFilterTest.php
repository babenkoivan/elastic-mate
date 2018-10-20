<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\UniqueTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class UniqueTokenFilterTest extends TestCase
{
    public function test_unique_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new UniqueTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_UNIQUE,
                'only_on_same_position' => true
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_unique_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new UniqueTokenFilter('foo'))->setOnlyOnSamePosition(false);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_UNIQUE,
                'only_on_same_position' => false
            ],
            $tokenFilter->toArray()
        );
    }
}
