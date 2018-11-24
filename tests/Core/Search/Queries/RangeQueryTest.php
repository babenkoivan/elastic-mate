<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Content\Content;
use BabenkoIvan\ElasticMate\Core\Content\Types\Range;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Entities\Document;
use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\EntityManagers\BulkDocumentManager;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\DateProperty;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\IntegerNumericProperty;
use BabenkoIvan\ElasticMate\Core\Search\Request;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort;
use BabenkoIvan\ElasticMate\Traits\HasClient;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\RangeQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Types\Range
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
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\DateProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\IntegerNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\KeywordProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Request
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Response
 * @uses   \Illuminate\Support\Collection
 */
final class RangeQueryTest extends TestCase
{
    use HasClient;

    public function test_range_query_can_be_converted_to_array(): void
    {
        $range = collect([
            new Range('01/01/2012', Range::TYPE_GREATER_THAN),
            new Range('01/01/2015', Range::TYPE_LESS_THAN)
        ]);

        $rangeQuery = (new RangeQuery('foo', $range))
            ->setFormat('dd/MM/yyyy')
            ->setTimezone('+01:00')
            ->setBoost(1.9)
            ->setRelation(Query::RELATION_WITHIN);

        $this->assertSame(
            [
                'range' => [
                    'foo' => [
                        'gt' => '01/01/2012',
                        'lt' => '01/01/2015',
                        'format' => 'dd/MM/yyyy',
                        'time_zone' => '+01:00',
                        'relation' => Query::RELATION_WITHIN,
                        'boost' => 1.9,
                    ]
                ]
            ],
            $rangeQuery->toArray()
        );
    }

    /**
     * @return array
     */
    public function rangeQueryProvider(): array
    {
        return [
            [
                'integerField',
                Range::TYPE_GREATER_THAN,
                12,
                collect([
                    new Document('4', new Content(['integerField' => 15, 'dateField' => '2019-01-06 17:00:00']))
                ])
            ],
            [
                'dateField',
                Range::TYPE_LESS_THAN_OR_EQUAL,
                '2018-11-24 10:00:00',
                collect([
                    new Document('2', new Content(['integerField' => 5, 'dateField' => '2017-03-21 15:27:00'])),
                    new Document('3', new Content(['integerField' => 10, 'dateField' => '2018-11-24 10:00:00']))
                ])
            ],
        ];
    }

    /**
     * @dataProvider rangeQueryProvider
     * @testdox Range query "$field $type $value" retrieves relevant documents from index
     *
     * @param string $field
     * @param string $type
     * @param $value
     * @param Collection $expectedDocuments
     */
    public function test_range_query_retrieves_relevant_documents_from_index(
        string $field,
        string $type,
        $value,
        Collection $expectedDocuments
    ): void {
        $mapping = (new Mapping())
            ->addProperty(new IntegerNumericProperty('integerField'))
            ->addProperty((new DateProperty('dateField'))->setFormat('yyyy-MM-dd HH:mm:ss'));

        $index = (new Index('test'))
            ->setMapping($mapping);

        $documents = collect([
            new Document('1', new Content(['integerField' => 1, 'dateField' => '2020-08-10 12:36:45'])),
            new Document('2', new Content(['integerField' => 5, 'dateField' => '2017-03-21 15:27:00'])),
            new Document('3', new Content(['integerField' => 10, 'dateField' => '2018-11-24 10:00:00'])),
            new Document('4', new Content(['integerField' => 15, 'dateField' => '2019-01-06 17:00:00']))
        ]);

        $indexManager = new IndexManager($this->client);
        $documentManager = new BulkDocumentManager($this->client);

        $indexManager->create($index);
        $documentManager->index($index, $documents, true);

        $query = new RangeQuery($field, collect([new Range($value, $type)]));
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
