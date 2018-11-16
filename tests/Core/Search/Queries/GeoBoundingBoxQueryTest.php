<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\GeoBoundingBoxQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint
 */
final class GeoBoundingBoxQueryTest extends TestCase
{
    public function test_geo_bounding_box_query_can_be_converted_to_array(): void
    {
        $topLeftPoint = new GeoPoint(40.73, -74.1);
        $bottomRightPoint = new GeoPoint(40.10, -71.12);

        $query = (new GeoBoundingBoxQuery('foo', $topLeftPoint, $bottomRightPoint))
            ->setValidationMethod(Query::VALIDATION_METHOD_COERCE)
            ->setType(Query::EXECUTION_TYPE_INDEXED);

        $this->assertSame(
            [
                'geo_bounding_box' => [
                    'foo' => [
                        'top_left' => [
                            'lat' => $topLeftPoint->getLatitude(),
                            'lon' => $topLeftPoint->getLongitude()
                        ],
                        'bottom_right' => [
                            'lat' => $bottomRightPoint->getLatitude(),
                            'lon' => $bottomRightPoint->getLongitude()
                        ]
                    ],
                    'validation_method' => Query::VALIDATION_METHOD_COERCE,
                    'type' => Query::EXECUTION_TYPE_INDEXED
                ]
            ],
            $query->toArray()
        );
    }
}
