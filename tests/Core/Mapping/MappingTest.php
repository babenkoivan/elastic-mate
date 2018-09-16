<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty
 */
class MappingTest extends TestCase
{
    public function test_mapping_can_be_converted_to_array(): void
    {
        $mapping = (new Mapping())
            ->addProperty(new TextProperty('foo'))
            ->addProperty(new TextProperty('bar'));

        $this->assertSame(
            [
                'properties' => [
                    'foo' => [
                        'type' => 'text'
                    ],
                    'bar' => [
                        'type' => 'text'
                    ],
                ]
            ],
            $mapping->toArray()
        );
    }
}
