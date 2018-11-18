<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping;

use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use BabenkoIvan\ElasticMate\Traits\HasClient;
use BabenkoIvan\ElasticMate\Traits\HasMappingAssertions;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 */
final class TextPropertyTest extends TestCase
{
    use HasClient, HasMappingAssertions;

    public function test_text_property_has_correct_default_values(): void
    {
        $textProperty = new TextProperty('foo');

        $this->assertSame(
            [
                'type' => 'text',
                'boost' => 1,
                'eager_global_ordinals' => false,
                'fielddata' => false,
                'index' => true,
                'index_options' => Mapping::INDEX_OPTIONS_POSITIONS,
                'norms' => true,
                'store' => false,
                'similarity' => Mapping::SIMILARITY_BM25,
                'term_vector' => Mapping::TERM_VECTOR_NO
            ],
            $textProperty->toArray()
        );
    }

    public function test_text_property_can_be_converted_to_array(): void
    {
        $textProperty = (new TextProperty('foo'))
            ->setBoost(1.7)
            ->setEagerGlobalOrdinals(false)
            ->setFieldData(true)
            ->setIndex(false)
            ->setIndexOptions(Mapping::INDEX_OPTIONS_DOCS)
            ->setNorms(true)
            ->setStore(true)
            ->setSimilarity(Mapping::SIMILARITY_BOOLEAN)
            ->setTermVector(Mapping::TERM_VECTOR_WITH_POSITIONS_AND_OFFSETS)
            ->setAnalyzer('whitespace')
            ->setSearchAnalyzer('standard')
            ->setSearchQuoteAnalyzer('simple');

        $this->assertSame(
            [
                'type' => 'text',
                'boost' => 1.7,
                'eager_global_ordinals' => false,
                'fielddata' => true,
                'index' => false,
                'index_options' => Mapping::INDEX_OPTIONS_DOCS,
                'norms' => true,
                'store' => true,
                'similarity' => Mapping::SIMILARITY_BOOLEAN,
                'term_vector' => Mapping::TERM_VECTOR_WITH_POSITIONS_AND_OFFSETS,
                'analyzer' => 'whitespace',
                'search_analyzer' => 'standard',
                'search_quote_analyzer' => 'simple'
            ],
            $textProperty->toArray()
        );
    }

    public function test_text_property_can_be_created(): void
    {
        $mapping = (new Mapping())
            ->addProperty(
                new TextProperty('foo')
            )
            ->addProperty(
                (new TextProperty('bar'))
                    ->setBoost(1.7)
                    ->setEagerGlobalOrdinals(false)
                    ->setFieldData(true)
                    ->setIndex(false)
                    ->setIndexOptions(Mapping::INDEX_OPTIONS_DOCS)
                    ->setNorms(true)
                    ->setStore(true)
                    ->setSimilarity(Mapping::SIMILARITY_BOOLEAN)
                    ->setTermVector(Mapping::TERM_VECTOR_WITH_POSITIONS_AND_OFFSETS)
                    ->setAnalyzer('whitespace')
                    ->setSearchAnalyzer('standard')
                    ->setSearchQuoteAnalyzer('simple')
            );

        $index = (new Index('test'))
            ->setMapping($mapping);

        $indexManager = new IndexManager($this->client);
        $indexManager->create($index);

        $this->assertMappingMatch($mapping->toArray(), $this->getIndexMapping($index->getName()));
    }
}
