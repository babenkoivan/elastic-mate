<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\KeepTypesTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class KeepTypesTokenFilterTest extends TestCase
{
    public function test_keep_types_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new KeepTypesTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_KEEP_TYPES,
                'mode' => KeepTypesTokenFilter::MODE_INCLUDE,
                'types' => []
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_keep_types_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new KeepTypesTokenFilter('foo'))
            ->setMode(KeepTypesTokenFilter::MODE_EXCLUDE)
            ->addType('<NUM>');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_KEEP_TYPES,
                'mode' => KeepTypesTokenFilter::MODE_EXCLUDE,
                'types' => [
                    '<NUM>'
                ]
            ],
            $tokenFilter->toArray()
        );
    }
}
