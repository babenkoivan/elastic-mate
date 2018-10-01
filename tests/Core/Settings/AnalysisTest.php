<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analysis
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer
 */
class AnalysisTest extends TestCase
{
    public function test_analysis_can_be_converted_to_array(): void
    {
        $analysis = (new Analysis())
            ->addAnalyzer(new WhitespaceAnalyzer('foo'))
            ->addAnalyzer(new WhitespaceAnalyzer('bar'));

        $this->assertSame(
            [
                'analyzer' => [
                    'foo' => [
                        'type' => 'whitespace'
                    ],
                    'bar' => [
                        'type' => 'whitespace'
                    ],
                ]
            ],
            $analysis->toArray()
        );
    }
}
