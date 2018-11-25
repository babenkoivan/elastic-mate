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
use BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\AutoFuzziness;
use BabenkoIvan\ElasticMate\Core\Search\Request;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort;
use BabenkoIvan\ElasticMate\Traits\HasClient;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\FuzzyQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\AbstractFuzziness
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\AutoFuzziness
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
final class FuzzyQueryTest extends TestCase
{
    use HasClient;

    public function test_fuzzy_query_can_be_converted_to_array(): void
    {
        $fuzzyQuery = (new FuzzyQuery('foo', 'bar'))
            ->setFuzziness(new AutoFuzziness(2, 7, true))
            ->setPrefixLength(1)
            ->setMaxExpansions(40)
            ->setBoost(1.2);

        $this->assertSame(
            [
                'fuzzy' => [
                    'foo' => [
                        'value' => 'bar',
                        'prefix_length' => 1,
                        'max_expansions' => 40,
                        'fuzziness' => 'AUTO:2,7',
                        'transpositions' => true,
                        'boost' => 1.2
                    ]
                ]
            ],
            $fuzzyQuery->toArray()
        );
    }

    /**
     * @return array
     */
    public function fuzzyQueryProvider(): array
    {
        return [
            [
                'stringField',
                'fao',
                collect([
                    new Document('1', new Content(['stringField' => 'foo']))
                ])
            ],
            [
                'stringField',
                'bao',
                collect([
                    new Document('2', new Content(['stringField' => 'bar']))
                ])
            ]
        ];
    }

    /**
     * @dataProvider fuzzyQueryProvider
     * @testdox Fuzzy query "$field = $value" retrieves relevant documents from index
     *
     * @param string $field
     * @param string $value
     * @param Collection $expectedDocuments
     */
    public function test_fuzzy_query_retrieves_relevant_documents_from_index(
        string $field,
        string $value,
        Collection $expectedDocuments
    ): void {
        $mapping = (new Mapping())
            ->addProperty(new TextProperty('stringField'));

        $index = (new Index('test'))
            ->setMapping($mapping);

        $documents = collect([
            new Document('1', new Content(['stringField' => 'foo'])),
            new Document('2', new Content(['stringField' => 'bar']))
        ]);

        $indexManager = new IndexManager($this->client);
        $documentManager = new BulkDocumentManager($this->client);

        $indexManager->create($index);
        $documentManager->index($index, $documents, true);

        $query = new FuzzyQuery($field, $value);
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
