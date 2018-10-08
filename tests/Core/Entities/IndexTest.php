<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Entities;

use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Settings;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Entities\Index
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analysis
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 */
class IndexTest extends TestCase
{
    public function test_index_can_be_created_and_properties_can_be_received_via_getters(): void
    {
        $mapping = (new Mapping())
            ->addProperty(new TextProperty('foo'));

        $analysis = (new Analysis())
            ->addAnalyzer(new StandardAnalyzer('bar'));

        $settings = (new Settings())
            ->setAnalysis($analysis);

        $index = (new Index('foo'))
            ->setMapping($mapping)
            ->setSettings($settings);

        $this->assertSame('foo', $index->getName());
        $this->assertSame($mapping, $index->getMapping());
        $this->assertSame($settings, $index->getSettings());
    }
}
