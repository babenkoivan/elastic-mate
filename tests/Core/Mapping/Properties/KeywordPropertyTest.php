<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\KeywordProperty
 */
final class KeywordPropertyTest extends TestCase
{
    public function test_keyword_property_can_be_converted_to_array(): void
    {
        $keywordProperty = new KeywordProperty(
            'foo',
            false,
            true,
            false,
            'bar',
            true,
            1028,
            Property::INDEX_OPTIONS_DOCS,
            Property::SIMILARITY_CLASSIC,
            false,
            false,
            'NULL',
            1.6
        );

        $this->assertSame(
            [
                'type' => 'keyword',
                'doc_values' => false,
                'store' => true,
                'index' => false,
                'normalizer' => 'bar',
                'eager_global_ordinals' => true,
                'ignore_above' => 1028,
                'index_options' => Property::INDEX_OPTIONS_DOCS,
                'similarity' => Property::SIMILARITY_CLASSIC,
                'norms' => false,
                'split_queries_on_whitespace' => false,
                'null_value' => 'NULL',
                'boost' => 1.6
            ],
            $keywordProperty->toArray()
        );
    }
}
