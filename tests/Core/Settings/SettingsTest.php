<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StopAnalyzer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analysis
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StopAnalyzer
 */
class SettingsTest extends TestCase
{
    public function test_settings_can_be_converted_to_array(): void
    {
        $analysis = (new Analysis())
            ->addAnalyzer(new StandardAnalyzer('foo'))
            ->addAnalyzer(new StopAnalyzer('bar'));

        $settings = (new Settings())
            ->setNumberOfShards(10)
            ->setAnalysis($analysis);

        $this->assertSame(
            [
                'number_of_shards' => 10,
                'analysis' => $analysis->toArray()
            ],
            $settings->toArray()
        );
    }
}
