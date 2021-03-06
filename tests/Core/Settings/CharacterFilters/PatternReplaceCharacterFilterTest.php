<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\CharacterFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\PatternReplaceCharacterFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\AbstractCharacterFilter
 */
final class PatternReplaceCharacterFilterTest extends TestCase
{
    public function test_pattern_replace_character_filter_has_correct_default_values(): void
    {
        $characterFilter = new PatternReplaceCharacterFilter('foo');

        $this->assertSame(
            [
                'type' => CharacterFilter::TYPE_PATTERN_REPLACE,
                'pattern' => '\W+',
                'replacement' => ' '
            ],
            $characterFilter->toArray()
        );
    }

    public function test_pattern_replace_character_filter_can_be_converted_to_array(): void
    {
        $characterFilter = (new PatternReplaceCharacterFilter('foo'))
            ->setPattern('(\\d+)-(?=\\d)')
            ->setReplacement('$1_')
            ->addFlag(Analysis::REGEXP_FLAG_CASE_INSENSITIVE)
            ->addFlag(Analysis::REGEXP_FLAG_COMMENTS);

        $this->assertSame(
            [
                'type' => CharacterFilter::TYPE_PATTERN_REPLACE,
                'pattern' => '(\\d+)-(?=\\d)',
                'replacement' => '$1_',
                'flags' => implode('|', [
                    Analysis::REGEXP_FLAG_CASE_INSENSITIVE,
                    Analysis::REGEXP_FLAG_COMMENTS
                ])
            ],
            $characterFilter->toArray()
        );
    }
}
