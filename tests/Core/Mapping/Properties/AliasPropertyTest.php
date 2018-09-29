<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AliasProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class AliasPropertyTest extends TestCase
{
    public function test_alias_property_can_be_converted_to_array(): void
    {
        $aliasProperty = new AliasProperty('foo', 'bar');

        $this->assertSame(
            [
                'type' => 'alias',
                'path' => 'bar'
            ],
            $aliasProperty->toArray()
        );
    }
}
