<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Support;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Support\StemmingRule
 */
final class StemmingRuleTest extends TestCase
{
    public function test_stemming_rule_can_be_converted_to_string(): void
    {
        $this->assertSame(
            'running => run',
            (new StemmingRule('running', 'run'))->toString()
        );
    }
}
