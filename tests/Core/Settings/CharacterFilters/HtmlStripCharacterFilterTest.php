<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\CharacterFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\HtmlStripCharacterFilter
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\AbstractCharacterFilter
 */
final class HtmlStripCharacterFilterTest extends TestCase
{
    public function test_html_strip_character_filter_can_be_converted_to_array(): void
    {
        $characterFilter = (new HtmlStripCharacterFilter('foo'))
            ->escapeTag('b')
            ->escapeTag('a');

        $this->assertSame(
            [
                'type' => CharacterFilter::TYPE_HTML_STRIP,
                'escaped_tags' => ['b', 'a']
            ],
            $characterFilter->toArray()
        );
    }
}
