<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\KeywordProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class KeywordPropertyTest extends TestCase
{
    public function test_keyword_property_has_correct_default_values(): void
    {
        $keywordProperty = new KeywordProperty('foo');

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
                'null_value' => null,
                'store' => false,
                'similarity' => Mapping::SIMILARITY_BM25,
                'normalizer' => null,
                'split_queries_on_whitespace' => false
            ],
            $keywordProperty->toArray()
        );
    }

    public function test_keyword_property_can_be_converted_to_array(): void
    {
        $keywordProperty = (new KeywordProperty('foo'))
            ->setDocValues(false)
            ->setStored(true)
            ->setIndexed(false)
            ->setNormalizer('bar')
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
                'null_value' => 'NULL',
                'store' => true,
                'similarity' => Mapping::SIMILARITY_CLASSIC,
                'normalizer' => 'bar',
                'split_queries_on_whitespace' => false
            ],
            $keywordProperty->toArray()
        );
    }
}
