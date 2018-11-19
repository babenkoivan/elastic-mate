<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Content\Types;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Content\Types\GeoDistance
 */
final class GeoDistanceTest extends TestCase
{
    public function test_geo_distance_can_be_created_and_properties_can_be_received_via_getters(): void
    {
        $geoDistance = new GeoDistance(100.70, GeoDistance::UNIT_KILOMETER);

        $this->assertSame(100.70, $geoDistance->getValue());
        $this->assertSame(GeoDistance::UNIT_KILOMETER, $geoDistance->getUnit());
    }
}
