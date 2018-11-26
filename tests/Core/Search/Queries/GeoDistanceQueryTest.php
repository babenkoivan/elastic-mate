<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Content\Content;
use BabenkoIvan\ElasticMate\Core\Content\Types\GeoDistance;
use BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Entities\Document;
use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\EntityManagers\BulkDocumentManager;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\GeoPointProperty;
use BabenkoIvan\ElasticMate\Core\Search\Request;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort;
use BabenkoIvan\ElasticMate\Traits\HasClient;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\GeoDistanceQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Types\GeoDistance
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Content
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Mutators\ContentMutator
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Document
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\BulkDocumentManager
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\GeoPointProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Request
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Response
 * @uses   \Illuminate\Support\Collection
 */
final class GeoDistanceQueryTest extends TestCase
{
    use HasClient;

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

    public function geoDistanceQueryProvider(): array
    {
        return [
            [
                'pointField',
                0,
                0,
                120,
                GeoDistance::UNIT_KILOMETER,
                collect([
                    new Document('1', new Content(['pointField' => ['lat' => 0, 'lon' => 1]]))
                ])
            ],
            [
                'pointField',
                0,
                0,
                240,
                GeoDistance::UNIT_KILOMETER,
                collect([
                    new Document('1', new Content(['pointField' => ['lat' => 0, 'lon' => 1]])),
                    new Document('2', new Content(['pointField' => ['lat' => 0, 'lon' => 2]]))
                ])
            ]
        ];
    }

    /**
     * @dataProvider geoDistanceQueryProvider
     * @testdox Geo distance query "$field in $distance $unit from [$lat,$lon]" retrieves documents from index
     *
     * @param string $field
     * @param float $lat
     * @param float $lon
     * @param float $distance
     * @param string $unit
     * @param Collection $expectedDocuments
     */
    public function test_geo_distance_query_retrieves_relevant_documents_from_index(
        string $field,
        float $lat,
        float $lon,
        float $distance,
        string $unit,
        Collection $expectedDocuments
    ): void {
        $mapping = (new Mapping())
            ->addProperty(new GeoPointProperty('pointField'));

        $index = (new Index('test'))
            ->setMapping($mapping);

        $documents = collect([
            new Document('1', new Content(['pointField' => ['lat' => 0, 'lon' => 1]])),
            new Document('2', new Content(['pointField' => ['lat' => 0, 'lon' => 2]]))
        ]);

        $indexManager = new IndexManager($this->client);
        $documentManager = new BulkDocumentManager($this->client);

        $indexManager->create($index);
        $documentManager->index($index, $documents, true);

        $query = new GeoDistanceQuery(
            $field,
            new GeoPoint($lat, $lon),
            new GeoDistance($distance, $unit)
        );

        $sort = new SimpleSort(collect([new FieldSort('_id', FieldSort::ORDER_ASC)]));

        $request = (new Request($query))
            ->setSort($sort);

        $response = $documentManager->search($index, $request);

        $this->assertEquals(
            $expectedDocuments,
            $response->getDocuments()
        );
    }
}
