<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\LongNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class LongNumericPropertyTest extends TestCase
{
    public function test_long_numeric_property_has_correct_default_values(): void
    {
        $property = new LongNumericProperty('foo');

        $this->assertSame(
            [
                'type' => 'long',
                'coerce' => true,
                'boost' => 1,
                'doc_values' => true,
                'ignore_malformed' => false,
                'index' => true,
                'null_value' => null,
                'store' => false
            ],
            $property->toArray()
        );
    }

    public function test_long_numeric_property_can_be_converted_to_array(): void
    {
        $property = (new LongNumericProperty('foo'))
            ->setCoerced(false)
            ->setBoost(1.7)
            ->setDocValues(false)
            ->setIgnoreMalformed(true)
            ->setIndexed(false)
            ->setNullValue('NULL')
            ->setStored(true);

        $this->assertSame(
            [
                'type' => 'long',
                'coerce' => false,
                'boost' => 1.7,
                'doc_values' => false,
                'ignore_malformed' => true,
                'index' => false,
                'null_value' => 'NULL',
                'store' => true
            ],
            $property->toArray()
        );
    }
}
