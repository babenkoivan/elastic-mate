<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint;
use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Traits\HasClient;
use BabenkoIvan\ElasticMate\Traits\HasMappingAssertions;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\GeoPointProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 */
final class GeoPointPropertyTest extends TestCase
{
    use HasClient, HasMappingAssertions;

    public function test_geo_point_property_has_correct_default_values(): void
    {
        $property = new GeoPointProperty('foo');

        $this->assertSame(
            [
                'type' => 'geo_point',
                'ignore_malformed' => false,
                'ignore_z_value' => true
            ],
            $property->toArray()
        );
    }

    public function test_geo_point_property_can_be_converted_to_array(): void
    {
        $property = (new GeoPointProperty('foo'))
            ->setIgnoreMalformed(true)
            ->setIgnoreZValue(false)
            ->setNullValue(new GeoPoint(0, 0));

        $this->assertSame(
            [
                'type' => 'geo_point',
                'ignore_malformed' => true,
                'ignore_z_value' => false,
                'null_value' => [
                    'lat' => 0.0,
                    'lon' => 0.0
                ]
            ],
            $property->toArray()
        );
    }

    public function test_geo_point_property_can_be_created(): void
    {
        $mapping = (new Mapping())
            ->addProperty(
                new GeoPointProperty('foo')
            )
            ->addProperty(
                (new GeoPointProperty('bar'))
                    ->setIgnoreMalformed(true)
                    ->setIgnoreZValue(false)
                    ->setNullValue(new GeoPoint(0, 0))
            );

        $index = (new Index('test'))
            ->setMapping($mapping);

        $indexManager = new IndexManager($this->client);
        $indexManager->create($index);

        $this->assertMappingMatch($mapping->toArray(), $this->getIndexMapping($index->getName()));
    }
}
