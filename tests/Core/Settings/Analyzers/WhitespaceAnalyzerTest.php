<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer
 * @uses \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 */
class WhitespaceAnalyzerTest extends TestCase
{
    public function test_whitespace_analyzer_can_be_converted_to_array(): void
    {
        $this->assertSame(
            [
                'type' => 'whitespace'
            ],
            (new WhitespaceAnalyzer('foo'))->toArray()
        );
    }
}
