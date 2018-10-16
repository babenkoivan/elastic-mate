<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\LengthTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class LengthTokenFilterTest extends TestCase
{
    public function test_length_toke_filter_has_correct_default_values(): void
    {
        $tokenFilter = new LengthTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_LENGTH,
                'min' => 0,
                'max' => 2147483647
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_length_toke_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new LengthTokenFilter('foo'))
            ->setMin(10)
            ->setMax(1000);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_LENGTH,
                'min' => 10,
                'max' => 1000
            ],
            $tokenFilter->toArray()
        );
    }
}
