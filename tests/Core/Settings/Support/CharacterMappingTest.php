<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Support;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Support\CharacterMapping
 */
final class CharacterMappingTest extends TestCase
{
    public function test_mapping_can_be_converted_to_string(): void
    {
        $this->assertSame(
            'foo => bar',
            (new CharacterMapping('foo', 'bar'))->toString()
        );
    }
}
