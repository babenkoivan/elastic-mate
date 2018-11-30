<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Content\Content;
use BabenkoIvan\ElasticMate\Core\Entities\Document;
use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\EntityManagers\BulkDocumentManager;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use BabenkoIvan\ElasticMate\Core\Search\Request;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort;
use BabenkoIvan\ElasticMate\Traits\HasClient;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\MatchPhraseQuery
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
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Request
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Response
 * @uses   \Illuminate\Support\Collection
 */
final class MatchPhraseQueryTest extends TestCase
{
    use HasClient;

    public function test_match_phrase_query_can_be_converted_to_array(): void
    {
        $matchPhraseQuery = (new MatchPhraseQuery('foo', 'bar'))
            ->setAnalyzer('whitespace')
            ->setSlop(2);

        $this->assertSame(
            [
                'match_phrase' => [
                    'foo' => [
                        'query' => 'bar',
                        'slop' => 2,
                        'analyzer' => 'whitespace'
                    ]
                ]
            ],
            $matchPhraseQuery->toArray()
        );
    }

    /**
     * @return array
     */
    public function matchPhraseQueryProvider(): array
    {
        return [
            [
                'stringField',
                'is foo',
                collect([
                    new Document('1', new Content(['stringField' => 'this is foo']))
                ])
            ],
            [
                'stringField',
                'this is',
                collect([
                    new Document('1', new Content(['stringField' => 'this is foo'])),
                    new Document('2', new Content(['stringField' => 'this is bar']))
                ])
            ]
        ];
    }

    /**
     * @dataProvider matchPhraseQueryProvider
     * @testdox Match phrase query "$field = $value" retrieves relevant documents from index
     *
     * @param string $field
     * @param string $value
     * @param Collection $expectedDocuments
     */
    public function test_match_phrase_query_retrieves_relevant_documents_from_index(
        string $field,
        string $value,
        Collection $expectedDocuments
    ): void {
        $mapping = (new Mapping())
            ->addProperty(new TextProperty('stringField'));

        $index = (new Index('test'))
            ->setMapping($mapping);

        $documents = collect([
            new Document('1', new Content(['stringField' => 'this is foo'])),
            new Document('2', new Content(['stringField' => 'this is bar']))
        ]);

        $indexManager = new IndexManager($this->client);
        $documentManager = new BulkDocumentManager($this->client);

        $indexManager->create($index);
        $documentManager->index($index, $documents, true);

        $query = new MatchPhraseQuery($field, $value);
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
