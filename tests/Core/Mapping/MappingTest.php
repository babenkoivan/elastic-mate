<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping;

use BabenkoIvan\ElasticMate\Core\Contracts\Content\Mutator;
use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty
 */
final class MappingTest extends TestCase
{
    public function test_source_can_be_disabled(): void
    {
        $mapping = (new Mapping())->setSourceEnabled(false);

        $this->assertEquals(
            [
                '_source' => [
                    'enabled' => false
                ]
            ],
            $mapping->toArray()
        );
    }

    public function test_mapping_can_be_converted_to_array(): void
    {
        $mapping = (new Mapping())
            ->addProperty(new TextProperty('foo'))
            ->addProperty(new TextProperty('bar'));

        $this->assertSame(
            [
                '_source' => [
                    'enabled' => true
                ],
                'properties' => [
                    'foo' => [
                        'type' => 'text',
                        'boost' => 1,
                        'eager_global_ordinals' => false,
                        'fielddata' => false,
                        'index' => true,
                        'index_options' => Mapping::INDEX_OPTIONS_POSITIONS,
                        'norms' => true,
                        'store' => false,
                        'similarity' => Mapping::SIMILARITY_BM25,
                        'term_vector' => Mapping::TERM_VECTOR_NO
                    ],
                    'bar' => [
                        'type' => 'text',
                        'boost' => 1,
                        'eager_global_ordinals' => false,
                        'fielddata' => false,
                        'index' => true,
                        'index_options' => Mapping::INDEX_OPTIONS_POSITIONS,
                        'norms' => true,
                        'store' => false,
                        'similarity' => Mapping::SIMILARITY_BM25,
                        'term_vector' => Mapping::TERM_VECTOR_NO
                    ],
                ]
            ],
            $mapping->toArray()
        );
    }

    public function test_mapping_can_return_properties(): void
    {
        $mapping = new Mapping();

        $properties = collect([
            new TextProperty('foo'),
            new TextProperty('bar')
        ]);

        $properties->each(function (Property $property) use ($mapping) {
            $mapping->addProperty($property);
        });

        $this->assertEquals($properties, $mapping->getProperties());
    }
}
