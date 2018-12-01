<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Content\Content;
use BabenkoIvan\ElasticMate\Core\Content\Types\Range;
use BabenkoIvan\ElasticMate\Core\Entities\Document;
use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\EntityManagers\BulkDocumentManager;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\IntegerNumericProperty;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\KeywordProperty;
use BabenkoIvan\ElasticMate\Core\Search\Request;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort;
use BabenkoIvan\ElasticMate\Traits\HasClient;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\BoolQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\ExistsQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\TermQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\RangeQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\RegexpQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\WildcardQuery
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Content
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Mutators\ContentMutator
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Types\Range
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Document
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\BulkDocumentManager
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\IntegerNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\KeywordProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Request
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Response
 * @uses   \Illuminate\Support\Collection
 */
final class BoolQueryTest extends TestCase
{
    use HasClient;

    public function test_bool_query_can_be_converted_to_array(): void
    {
        $mustQuery = new TermQuery('field1', 'foo');
        $mustNotQuery = new TermQuery('field3', 'bar');
        $firstShouldQuery = new RegexpQuery('field4', 't.*t');
        $secondShouldQuery = new WildcardQuery('field4', 't***t');
        $filterQuery = (new BoolQuery())->addMustNot(new ExistsQuery('field2'));
        $minimumShouldMatch = 2;
        $boost = 1.9;

        $boolQuery = (new BoolQuery())
            ->addMust($mustQuery)
            ->addMustNot($mustNotQuery)
            ->addShould($firstShouldQuery)
            ->addShould($secondShouldQuery)
            ->addFilter($filterQuery)
            ->setMinimumShouldMatch($minimumShouldMatch)
            ->setBoost($boost);

        $this->assertSame(
            [
                'bool' => [
                    'must' => [
                        $mustQuery->toArray()
                    ],
                    'must_not' => [
                        $mustNotQuery->toArray()
                    ],
                    'should' => [
                        $firstShouldQuery->toArray(),
                        $secondShouldQuery->toArray()
                    ],
                    'filter' => [
                        $filterQuery->toArray()
                    ],
                    'minimum_should_match' => $minimumShouldMatch,
                    'boost' => $boost
                ]
            ],
            $boolQuery->toArray()
        );
    }

    public function test_bool_query_retrieves_relevant_documents_from_index(): void
    {
        $mapping = (new Mapping())
            ->addProperty(new KeywordProperty('stringField'))
            ->addProperty(new IntegerNumericProperty('integerField'));

        $index = (new Index('test'))
            ->setMapping($mapping);

        $documents = collect([
            new Document('1', new Content([
                'stringField' => 'first',
                'integerField' => 1
            ])),
            new Document('2', new Content([
                'stringField' => 'second',
                'integerField' => 2
            ])),
            new Document('3', new Content([
                'stringField' => 'third',
                'integerField' => 3
            ])),
            new Document('4', new Content([
                'stringField' => 'fourth'
            ])),
            new Document('5', new Content([
                'stringField' => 'fifth',
                'integerField' => 5
            ]))
        ]);

        $indexManager = new IndexManager($this->client);
        $documentManager = new BulkDocumentManager($this->client);

        $indexManager->create($index);
        $documentManager->index($index, $documents, true);

        $query = (new BoolQuery())
            ->addMust(new ExistsQuery('integerField'))
            ->addMustNot(new RangeQuery('integerField', collect([new Range(2, Range::TYPE_LESS_THAN)])))
            ->addShould(new TermQuery('stringField', 'second'))
            ->addShould(new TermQuery('stringField', 'third'))
            ->setMinimumShouldMatch(1)
            ->addFilter(new RangeQuery('integerField', collect([new Range(2, Range::TYPE_GREATER_THAN)])));

        $sort = new SimpleSort(collect([new FieldSort('_id', FieldSort::ORDER_ASC)]));

        $request = (new Request($query))
            ->setSort($sort);

        $response = $documentManager->search($index, $request);

        $this->assertEquals(
            collect([
                new Document('3', new Content([
                    'stringField' => 'third',
                    'integerField' => 3
                ]))
            ]),
            $response->getDocuments()
        );
    }
}
