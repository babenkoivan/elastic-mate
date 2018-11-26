<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Content\Content;
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
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\GeoBoundingBoxQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint
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
final class GeoBoundingBoxQueryTest extends TestCase
{
    use HasClient;

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

    /**
     * @return array
     */
    public function geoBoundingBoxQueryProvider(): array
    {
        return [
            [
                'pointField',
                10,
                0,
                0,
                10,
                collect([
                    new Document('1', new Content(['pointField' => ['lat' => 3, 'lon' => 7]]))
                ])
            ],
            [
                'pointField',
                15,
                20,
                5,
                30,
                collect([
                    new Document('2', new Content(['pointField' => ['lat' => 12, 'lon' => 22]]))
                ])
            ]
        ];
    }

    /**
     * @dataProvider geoBoundingBoxQueryProvider
     * @testdox Geo bounding box query "$field in box [$topLeftLat,$topLeftLon]-[$bottomRightLat,$bottomRightLon]" retrieves relevant documents from index
     *
     * @param string $field
     * @param float $topLeftLat
     * @param float $topLeftLon
     * @param float $bottomRightLat
     * @param float $bottomRightLon
     * @param Collection $expectedDocuments
     */
    public function test_geo_bounding_box_query_retrieves_relevant_documents_from_index(
        string $field,
        float $topLeftLat,
        float $topLeftLon,
        float $bottomRightLat,
        float $bottomRightLon,
        Collection $expectedDocuments
    ): void {
        $mapping = (new Mapping())
            ->addProperty(new GeoPointProperty('pointField'));

        $index = (new Index('test'))
            ->setMapping($mapping);

        $documents = collect([
            new Document('1', new Content(['pointField' => ['lat' => 3, 'lon' => 7]])),
            new Document('2', new Content(['pointField' => ['lat' => 12, 'lon' => 22]]))
        ]);

        $indexManager = new IndexManager($this->client);
        $documentManager = new BulkDocumentManager($this->client);

        $indexManager->create($index);
        $documentManager->index($index, $documents, true);

        $query = new GeoBoundingBoxQuery(
            $field,
            new GeoPoint($topLeftLat, $topLeftLon),
            new GeoPoint($bottomRightLat, $bottomRightLon)
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
