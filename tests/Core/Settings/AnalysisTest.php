<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StopAnalyzer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analysis
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StopAnalyzer
 */
class AnalysisTest extends TestCase
{
    public function test_analysis_can_be_converted_to_array(): void
    {
        $standardAnalyzer = new StandardAnalyzer('foo');
        $stopAnalyzer = new StopAnalyzer('bar');

        $analysis = (new Analysis())
            ->addAnalyzer($standardAnalyzer)
            ->addAnalyzer($stopAnalyzer);

        $this->assertSame(
            [
                'analyzer' => [
                    'foo' => $standardAnalyzer->toArray(),
                    'bar' => $stopAnalyzer->toArray(),
                ]
            ],
            $analysis->toArray()
        );
    }
}
