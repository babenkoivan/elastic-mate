<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Content\Types\GeoDistance;
use BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\GeoDistanceQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Types\GeoDistance
 */
final class GeoDistanceQueryTest extends TestCase
{
    public function test_geo_distance_query_can_be_converted_to_array(): void
    {
        $point = new GeoPoint(40, -70);
        $distance = new GeoDistance(12, GeoDistance::UNIT_KILOMETER);

        $query = (new GeoDistanceQuery('foo', $point, $distance))
            ->setDistanceType(Query::DISTANCE_TYPE_PLANE)
            ->setValidationMethod(Query::VALIDATION_METHOD_IGNORE_MALFORMED);

        $this->assertSame(
            [
                'geo_distance' => [
                    'foo' => [
                        'lat' => $point->getLatitude(),
                        'lon' => $point->getLongitude()
                    ],
                    'distance' => $distance->getValue() . $distance->getUnit(),
                    'distance_type' => Query::DISTANCE_TYPE_PLANE,
                    'validation_method' => Query::VALIDATION_METHOD_IGNORE_MALFORMED
                ]
            ],
            $query->toArray()
        );
    }
}
