<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\TruncateTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class TruncateTokenFilterTest extends TestCase
{
    public function test_truncate_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new TruncateTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_TRUNCATE,
                'length' => 10
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_truncate_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new TruncateTokenFilter('foo'))->setLength(5);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_TRUNCATE,
                'length' => 5
            ],
            $tokenFilter->toArray()
        );
    }
}
