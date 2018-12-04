<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Traits\HasClient;
use BabenkoIvan\ElasticMate\Traits\HasMappingAssertions;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\KeywordProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 */
final class KeywordPropertyTest extends TestCase
{
    use HasClient, HasMappingAssertions;

    public function test_keyword_property_has_correct_default_values(): void
    {
        $property = new KeywordProperty('foo');

        $this->assertSame(
            [
                'type' => 'keyword',
                'boost' => 1,
                'doc_values' => true,
                'eager_global_ordinals' => false,
                'ignore_above' => 2147483647,
                'index' => true,
                'index_options' => Mapping::INDEX_OPTIONS_DOCS,
                'norms' => false,
                'store' => false,
                'similarity' => Mapping::SIMILARITY_BM25,
                'split_queries_on_whitespace' => false
            ],
            $property->toArray()
        );
    }

    public function test_keyword_property_can_be_converted_to_array(): void
    {
        $property = (new KeywordProperty('foo'))
            ->setDocValues(false)
            ->setStore(true)
            ->setIndex(false)
            ->setEagerGlobalOrdinals(true)
            ->setIgnoreAbove(1028)
            ->setIndexOptions(Mapping::INDEX_OPTIONS_DOCS)
            ->setSimilarity(Mapping::SIMILARITY_CLASSIC)
            ->setNorms(false)
            ->setSplitQueriesOnWhitespace(false)
            ->setNullValue('NULL')
            ->setBoost(1.6);

        $this->assertSame(
            [
                'type' => 'keyword',
                'boost' => 1.6,
                'doc_values' => false,
                'eager_global_ordinals' => true,
                'ignore_above' => 1028,
                'index' => false,
                'index_options' => Mapping::INDEX_OPTIONS_DOCS,
                'norms' => false,
                'store' => true,
                'similarity' => Mapping::SIMILARITY_CLASSIC,
                'split_queries_on_whitespace' => false,
                'null_value' => 'NULL'
            ],
            $property->toArray()
        );
    }

    public function test_keyword_property_can_be_created(): void
    {
        $mapping = (new Mapping())
            ->addProperty(
                new KeywordProperty('foo')
            )
            ->addProperty(
                (new KeywordProperty('bar'))
                    ->setDocValues(false)
                    ->setStore(true)
                    ->setIndex(false)
                    ->setEagerGlobalOrdinals(true)
                    ->setIgnoreAbove(1028)
                    ->setIndexOptions(Mapping::INDEX_OPTIONS_DOCS)
                    ->setSimilarity(Mapping::SIMILARITY_CLASSIC)
                    ->setNorms(false)
                    ->setSplitQueriesOnWhitespace(false)
                    ->setNullValue('NULL')
                    ->setBoost(1.6)
            );

        $index = (new Index('test'))
            ->setMapping($mapping);

        $indexManager = new IndexManager($this->client);
        $indexManager->create($index);

        $this->assertMappingMatch($mapping->toArray(), $this->getIndexMapping($index->getName()));
    }
}
