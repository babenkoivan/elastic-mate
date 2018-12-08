<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\CharacterFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Support\CharacterMapping;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\MappingCharacterFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\AbstractCharacterFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Support\CharacterMapping
 */
final class MappingCharacterFilterTest extends TestCase
{
    public function test_mapping_character_filter_with_mappings_can_be_converted_to_array(): void
    {
        $characterFilter = (new MappingCharacterFilter('foo'))
            ->addMapping(new CharacterMapping('٠', '0'))
            ->addMapping(new CharacterMapping('١', '1'))
            ->addMapping(new CharacterMapping('٢', '2'));

        $this->assertSame(
            [
                'type' => CharacterFilter::TYPE_MAPPING,
                'mappings' => [
                    '٠ => 0',
                    '١ => 1',
                    '٢ => 2'
                ]
            ],
            $characterFilter->toArray()
        );
    }

    public function test_mapping_character_filter_with_mappings_path_can_be_converted_to_array(): void
    {
        $characterFilter = (new MappingCharacterFilter('foo'))
            ->setMappingsPath('/mappings.txt');

        $this->assertSame(
            [
                'type' => CharacterFilter::TYPE_MAPPING,
                'mappings_path' => '/mappings.txt'
            ],
            $characterFilter->toArray()
        );
    }
}
