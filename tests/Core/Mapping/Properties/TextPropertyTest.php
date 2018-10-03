<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping;

use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
class TextPropertyTest extends TestCase
{
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
                'index_options' => Property::INDEX_OPTIONS_POSITIONS,
                'norms' => true,
                'store' => false,
                'similarity' => Property::SIMILARITY_BM25,
                'term_vector' => Property::TERM_VECTOR_NO
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
            ->setIndexed(false)
            ->setIndexOptions(Property::INDEX_OPTIONS_DOCS)
            ->setNorms(true)
            ->setStored(true)
            ->setSimilarity(Property::SIMILARITY_BOOLEAN)
            ->setTermVector(Property::TERM_VECTOR_WITH_POSITIONS_AND_OFFSETS)
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
                'index_options' => Property::INDEX_OPTIONS_DOCS,
                'norms' => true,
                'store' => true,
                'similarity' => Property::SIMILARITY_BOOLEAN,
                'term_vector' => Property::TERM_VECTOR_WITH_POSITIONS_AND_OFFSETS,
                'analyzer' => 'whitespace',
                'search_analyzer' => 'standard',
                'search_quote_analyzer' => 'simple'
            ],
            $textProperty->toArray()
        );
    }
}
