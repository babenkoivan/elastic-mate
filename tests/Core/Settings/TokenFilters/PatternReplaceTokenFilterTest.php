<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\PatternReplaceTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class PatternReplaceTokenFilterTest extends TestCase
{
    public function test_pattern_replace_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new PatternReplaceTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_PATTERN_REPLACE,
                'pattern' => '\W+',
                'replacement' => ' '
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_pattern_replace_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new PatternReplaceTokenFilter('foo'))
            ->setPattern('\n')
            ->setReplacement('\t');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_PATTERN_REPLACE,
                'pattern' => '\n',
                'replacement' => '\t'
            ],
            $tokenFilter->toArray()
        );
    }
}
