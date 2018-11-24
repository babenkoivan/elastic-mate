<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Content\Content;
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
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\TermQuery
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
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\IntegerNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\KeywordProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Request
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Response
 * @uses   \Illuminate\Support\Collection
 */
final class TermQueryTest extends TestCase
{
    use HasClient;

    public function test_term_query_can_be_converted_to_array(): void
    {
        $termQuery = (new TermQuery('foo', 'bar'))->setBoost(1.5);

        $this->assertSame(
            [
                'term' => [
                    'foo' => [
                        'value' => 'bar',
                        'boost' => 1.5
                    ]
                ]
            ],
            $termQuery->toArray()
        );
    }

    /**
     * @return array
     */
    public function termQueriesProvider(): array
    {
        return [
            [
                'integerField',
                1,
                collect([
                    new Document('1', new Content(['integerField' => 1, 'stringField' => 'foo']))
                ])
            ],
            [
                'stringField',
                'bar',
                collect([
                    new Document('2', new Content(['integerField' => 2, 'stringField' => 'bar'])),
                    new Document('3', new Content(['integerField' => 3, 'stringField' => 'bar'])),
                ])
            ],
            [
                'integerField',
                4,
                collect()
            ],
        ];
    }

    /**
     * @dataProvider termQueriesProvider
     * @testdox Term query "$field = $value" retrieves relevant documents from index
     *
     * @param string $field
     * @param mixed $value
     * @param Collection $expectedDocuments
     */
    public function test_term_query_retrieves_relevant_documents_from_index(
        string $field,
        $value,
        Collection $expectedDocuments
    ): void {
        $mapping = (new Mapping())
            ->addProperty(new IntegerNumericProperty('integerField'))
            ->addProperty(new KeywordProperty('stringField'));

        $index = (new Index('test'))
            ->setMapping($mapping);

        $documents = collect([
            new Document('1', new Content(['integerField' => 1, 'stringField' => 'foo'])),
            new Document('2', new Content(['integerField' => 2, 'stringField' => 'bar'])),
            new Document('3', new Content(['integerField' => 3, 'stringField' => 'bar'])),
        ]);

        $indexManager = new IndexManager($this->client);
        $documentManager = new BulkDocumentManager($this->client);

        $indexManager->create($index);
        $documentManager->index($index, $documents, true);

        $query = new TermQuery($field, $value);
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
