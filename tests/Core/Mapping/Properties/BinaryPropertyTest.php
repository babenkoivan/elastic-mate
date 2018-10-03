<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\BinaryProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class BinaryPropertyTest extends TestCase
{
    public function test_binary_property_has_correct_default_values(): void
    {
        $binaryProperty = new BinaryProperty('foo');

        $this->assertSame(
            [
                'type' => 'binary',
                'doc_values' => false,
                'store' => false
            ],
            $binaryProperty->toArray()
        );
    }

    public function test_binary_property_can_be_converted_to_array(): void
    {
        $binaryProperty = (new BinaryProperty('foo'))
            ->setDocValues(true)
            ->setStored(true);

        $this->assertSame(
            [
                'type' => 'binary',
                'doc_values' => true,
                'store' => true
            ],
            $binaryProperty->toArray()
        );
    }
}
