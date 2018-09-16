<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty
 * @uses \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer
 */
class TextPropertyTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            ['foo', null],
            ['bar', new WhitespaceAnalyzer('whitespace')],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @testdox property "$name" can be created and converted to array
     * @param string $name
     * @param Analyzer|null $analyzer
     */
    public function test_property_can_be_created_and_converted_to_array(
        string $name,
        ?Analyzer $analyzer
    ): void {
        $expected = ['type' => 'text'];

        if (isset($analyzer)) {
            $expected['analyzer'] = $analyzer->getName();
        }

        $this->assertSame($expected, (new TextProperty($name, $analyzer))->toArray());
    }
}
