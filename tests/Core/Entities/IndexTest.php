<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Entities;

use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Settings;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Entities\Index
 * @uses \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses \BabenkoIvan\ElasticMate\Core\Settings\Settings
 */
class IndexTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                'foo',
                null,
                null
            ],
            [
                'bar',
                new Mapping(collect([new TextProperty('foo')])),
                new Settings(new Analysis(collect([new WhitespaceAnalyzer('bar')])))
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @testdox Index with name "$name" can be created and properties can be received via getters
     * @param string $name
     * @param Mapping|null $mapping
     * @param Settings|null $settings
     */
    public function test_index_can_be_created_and_properties_can_be_received_via_getters(
        string $name,
        ?Mapping $mapping,
        ?Settings $settings
    ): void {
        $index = new Index($name, $mapping, $settings);

        $this->assertSame($name, $index->getName());

        $this->assertThat($index->getMapping(), $this->logicalOr(
            $this->isNull(),
            $this->isInstanceOf(Mapping::class)
        ));

        $this->assertThat($index->getSettings(), $this->logicalOr(
            $this->isNull(),
            $this->isInstanceOf(Settings::class)
        ));
    }
}
