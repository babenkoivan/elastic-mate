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
    public function test_boolean_property_has_correct_default_values(): void
    {
        $booleanProperty = new BooleanProperty('foo');

        $this->assertSame(
            [
                'type' => 'boolean',
                'boost' => 1,
                'doc_values' => true,
                'index' => true,
                'store' => false
            ],
            $booleanProperty->toArray()
        );
    }

    public function test_boolean_property_can_be_converted_to_array(): void
    {
        $booleanProperty = (new BooleanProperty('foo'))
            ->setDocValues(true)
            ->setStore(true)
            ->setIndex(false)
            ->setNullValue('NULL')
            ->setBoost(1.1);

        $this->assertSame(
            [
                'type' => 'boolean',
                'boost' => 1.1,
                'doc_values' => true,
                'index' => false,
                'store' => true,
                'null_value' => 'NULL'
            ],
            $booleanProperty->toArray()
        );
    }
}
