<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\SnowBallTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class SnowBallTokenFilterTest extends TestCase
{
    public function test_snow_ball_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new SnowBallTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_SNOWBALL,
                'language' => ucfirst(Analysis::LANGUAGE_ENGLISH)
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_snow_ball_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new SnowBallTokenFilter('foo'))->setLanguage(Analysis::LANGUAGE_GERMAN);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_SNOWBALL,
                'language' => ucfirst(Analysis::LANGUAGE_GERMAN)
            ],
            $tokenFilter->toArray()
        );
    }
}
