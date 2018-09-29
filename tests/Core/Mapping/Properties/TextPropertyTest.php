<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer
 */
class TextPropertyTest extends TestCase
{
    public function test_text_property_without_analyzer_can_be_created_and_converted_to_array(): void
    {
        $this->assertSame(
            [
                'type' => 'text'
            ],
            (new TextProperty('foo'))->toArray()
        );
    }

    public function test_text_property_with_analyzer_can_be_created_and_converted_to_array(): void
    {
        $this->assertSame(
            [
                'type' => 'text',
                'analyzer' => 'whitespace'
            ],
            (new TextProperty('foo', 'whitespace'))->toArray()
        );
    }
}
