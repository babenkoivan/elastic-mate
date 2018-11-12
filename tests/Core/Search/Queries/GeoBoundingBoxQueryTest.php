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
        $query = (new GeoBoundingBoxQuery('foo', new GeoPoint(40.73, -74.1), new GeoPoint(40.10, -71.12)))
            ->setValidationMethod(Query::VALIDATION_METHOD_COERCE)
            ->setType(Query::EXECUTION_TYPE_INDEXED);

        $this->assertSame(
            [
                'geo_bounding_box' => [
                    'foo' => [
                        'top_left' => [
                            'lat' => 40.73,
                            'lon' => -74.1
                        ],
                        'bottom_right' => [
                            'lat' => 40.10,
                            'lon' => -71.12
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
