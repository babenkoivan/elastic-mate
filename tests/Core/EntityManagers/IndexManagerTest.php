<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\EntityManagers;

use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Settings;
use BabenkoIvan\ElasticMate\Dependencies\Client;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analysis
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 */
class IndexManagerTest extends TestCase
{
    use Client;

    /**
     * @var Index
     */
    private $index;

    /**
     * @var IndexManager
     */
    private $indexManager;

    public function test_index_existence_can_be_checked(): void
    {
        $this->createIndex($this->index->getName());
        $this->assertTrue($this->indexManager->exists($this->index));
    }

    public function test_index_can_be_created(): void
    {
        $this->indexManager
            ->create($this->index);

        $this->assertTrue($this->isIndexExists($this->index->getName()));

        $this->assertArraySubset(
            $this->index->getSettings()->toArray(),
            $this->getIndexSettings($this->index->getName())
        );

        $this->assertSame(
            $this->index->getMapping()->toArray(),
            $this->getIndexMapping($this->index->getName())
        );
    }

    public function test_index_can_be_deleted(): void
    {
        $this->createIndex($this->index->getName());

        $this->indexManager
            ->delete($this->index);

        $this->assertFalse($this->isIndexExists($this->index->getName()));
    }

    public function test_non_dynamic_settings_update_causes_exception_without_force(): void
    {
        $this->expectExceptionMessageRegExp('/.*?Can\'t update non dynamic settings.*?/');

        $this->createIndex($this->index->getName());

        $this->indexManager
            ->updateSettings($this->index);
    }

    public function test_settings_can_be_updated_with_force(): void
    {
        $this->createIndex($this->index->getName());

        $this->indexManager
            ->updateSettings($this->index, true);

        $this->assertArraySubset(
            $this->index->getSettings()->toArray(),
            $this->getIndexSettings($this->index->getName())
        );
    }

    public function test_mapping_can_be_updated(): void
    {
        $this->createIndex(
            $this->index->getName(),
            null,
            $this->index->getSettings()->toArray()
        );

        $this->indexManager
            ->updateMapping($this->index);

        $this->assertSame(
            $this->index->getMapping()->toArray(),
            $this->getIndexMapping($this->index->getName())
        );
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $analyzer = new WhitespaceAnalyzer('content');
        $analysis = (new Analysis())->addAnalyzer($analyzer);

        $mapping = (new Mapping())->addProperty(new TextProperty('content', $analyzer));
        $settings = new Settings($analysis);

        $this->index = new Index('test', $mapping, $settings);
        $this->indexManager = new IndexManager($this->client);
    }
}
