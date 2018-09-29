<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\BooleanProperty
 */
final class BooleanPropertyTest extends TestCase
{
    public function test_boolean_property_can_be_converted_to_array(): void
    {
        $booleanProperty = new BooleanProperty('foo', 1.1, true, false, 'NULL', true);

        $this->assertSame(
            [
                'type' => 'boolean',
                'boost' => 1.1,
                'doc_values' => true,
                'index' => false,
                'null_value' => 'NULL',
                'store' => true
            ],
            $booleanProperty->toArray()
        );
    }
}
