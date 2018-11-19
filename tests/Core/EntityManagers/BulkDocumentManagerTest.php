<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\EntityManagers;

use BabenkoIvan\ElasticMate\Core\Content\Content;
use BabenkoIvan\ElasticMate\Core\Contracts\EntityManagers\DocumentManager;
use BabenkoIvan\ElasticMate\Core\Entities\Document;
use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\Search\Queries\MatchAllQuery;
use BabenkoIvan\ElasticMate\Core\Search\Request;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort;
use BabenkoIvan\ElasticMate\Traits\HasClient;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\EntityManagers\BulkDocumentManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Mutators\ContentMutator
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Document
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\MatchAllQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Request
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Response
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 */
final class BulkDocumentManagerTest extends TestCase
{
    use HasClient;

    /**
     * @var Index
     */
    private $index;

    /**
     * @var DocumentManager
     */
    private $documentManager;

    public function test_documents_can_be_indexed_with_force(): void
    {
        $documents = collect([
            new Document('1', new Content(['name' => 'foo'])),
            new Document('2', new Content(['name' => 'bar']))
        ]);

        $this->documentManager
            ->index($this->index, $documents, true);

        $this->assertSame(
            [
                '1' => [
                    'name' => 'foo'
                ],
                '2' => [
                    'name' => 'bar'
                ]
            ],
            $this->getIndexDocuments($this->index->getName())
        );
    }

    public function test_documents_can_be_deleted_with_force(): void
    {
        $this->createIndexDocuments($this->index->getName(), [
            '1' => [
                'name' => 'foo'
            ],
            '2' => [
                'name' => 'bar'
            ]
        ]);

        $documents = collect([
            new Document('1', new Content(['name' => 'foo']))
        ]);

        $this->documentManager
            ->delete($this->index, $documents, true);

        $this->assertSame(
            [
                '2' => [
                    'name' => 'bar'
                ]
            ],
            $this->getIndexDocuments($this->index->getName())
        );
    }

    public function test_match_all_query_can_return_all_documents(): void
    {
        $this->createIndexDocuments($this->index->getName(), [
            '1' => [
                'name' => 'foo'
            ],
            '2' => [
                'name' => 'bar'
            ]
        ]);

        $query = new MatchAllQuery();
        $sort = new SimpleSort(collect([new FieldSort('_id', 'asc')]));
        $request = (new Request($query))->setSort($sort);

        $response = $this->documentManager
            ->search($this->index, $request);

        $documents = $response->getDocuments();
        $total = $response->getTotal();

        $this->assertSame(2, $total);
        $this->assertSame('1', $documents->get(0)->getId());
        $this->assertSame(['name' => 'foo'], $documents->get(0)->getContent()->all());
        $this->assertSame('2', $documents->get(1)->getId());
        $this->assertSame(['name' => 'bar'], $documents->get(1)->getContent()->all());
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->index = new Index('test');
        $this->documentManager = new BulkDocumentManager($this->client);

        $this->createIndex($this->index->getName());
    }
}
