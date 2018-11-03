<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Support;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Support\CharMapping
 */
final class MappingTest extends TestCase
{
    public function test_mapping_can_be_converted_to_string(): void
    {
        $this->assertSame(
            'foo => bar',
            (new CharMapping('foo', 'bar'))->toString()
        );
    }
}
