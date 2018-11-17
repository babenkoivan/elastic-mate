<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\GeoPointProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class GeoPointPropertyTest extends TestCase
{
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
            ->setNullValue('NULL');

        $this->assertSame(
            [
                'type' => 'geo_point',
                'ignore_malformed' => true,
                'ignore_z_value' => false,
                'null_value' => 'NULL'
            ],
            $property->toArray()
        );
    }
}
