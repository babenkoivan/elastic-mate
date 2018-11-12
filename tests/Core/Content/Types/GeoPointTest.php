<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Content\Types;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint
 */
final class GeoPointTest extends TestCase
{
    public function test_geo_point_can_be_created_and_properties_can_be_received_via_getters(): void
    {
        $geoPoint = new GeoPoint(40.73, -74.1);

        $this->assertSame(40.73, $geoPoint->getLatitude());
        $this->assertSame(-74.1, $geoPoint->getLongitude());
    }
}
