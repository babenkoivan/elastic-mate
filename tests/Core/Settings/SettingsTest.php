<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analysis
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer
 */
class SettingsTest extends TestCase
{
    public function test_settings_creation_causes_error_if_no_options_specified(): void
    {
        $this->expectExceptionMessage(
            'At least one of the configurations must be used: analysis'
        );

        new Settings();
    }

    public function test_settings_can_be_converted_to_array(): void
    {
        $analysis = new Analysis(collect([
            new WhitespaceAnalyzer('foo'),
            new WhitespaceAnalyzer('bar')
        ]));

        $this->assertSame(
            [
                'analysis' => $analysis->toArray()
            ],
            (new Settings($analysis))->toArray()
        );
    }
}
