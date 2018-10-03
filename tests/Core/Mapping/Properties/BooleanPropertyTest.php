<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\BooleanProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class BooleanPropertyTest extends TestCase
{
    public function test_boolean_property_can_be_converted_to_array(): void
    {
        $booleanProperty = (new BooleanProperty('foo'))
            ->setDocValues(true)
            ->setStored(true)
            ->setIndexed(false)
            ->setNullValue('NULL')
            ->setBoost(1.1);

        $this->assertSame(
            [
                'type' => 'boolean',
                'doc_values' => true,
                'store' => true,
                'index' => false,
                'null_value' => 'NULL',
                'boost' => 1.1
            ],
            $booleanProperty->toArray()
        );
    }
}
