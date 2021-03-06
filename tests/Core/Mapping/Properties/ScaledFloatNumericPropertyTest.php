<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Traits\HasClient;
use BabenkoIvan\ElasticMate\Traits\HasMappingAssertions;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\ScaledFloatNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 */
final class ScaledFloatNumericPropertyTest extends TestCase
{
    use HasClient, HasMappingAssertions;

    public function test_scaled_float_numeric_property_has_correct_default_values(): void
    {
        $property = new ScaledFloatNumericProperty('foo');

        $this->assertSame(
            [
                'type' => 'scaled_float',
                'coerce' => true,
                'boost' => 1,
                'doc_values' => true,
                'ignore_malformed' => false,
                'index' => true,
                'store' => false,
                'scaling_factor' => 1
            ],
            $property->toArray()
        );
    }

    public function test_scaled_float_numeric_property_can_be_converted_to_array(): void
    {
        $property = (new ScaledFloatNumericProperty('foo'))
            ->setCoerce(false)
            ->setBoost(1.7)
            ->setDocValues(false)
            ->setIgnoreMalformed(true)
            ->setIndex(false)
            ->setNullValue(0)
            ->setStore(true)
            ->setScalingFactor(100);

        $this->assertSame(
            [
                'type' => 'scaled_float',
                'coerce' => false,
                'boost' => 1.7,
                'doc_values' => false,
                'ignore_malformed' => true,
                'index' => false,
                'store' => true,
                'null_value' => 0,
                'scaling_factor' => 100
            ],
            $property->toArray()
        );
    }

    public function test_scaled_float_numeric_property_can_be_created(): void
    {
        $mapping = (new Mapping())
            ->addProperty(
                new ScaledFloatNumericProperty('foo')
            )
            ->addProperty(
                (new ScaledFloatNumericProperty('bar'))
                    ->setCoerce(false)
                    ->setBoost(1.7)
                    ->setDocValues(false)
                    ->setIgnoreMalformed(true)
                    ->setIndex(false)
                    ->setNullValue(0)
                    ->setStore(true)
                    ->setScalingFactor(100)
            );

        $index = (new Index('test'))
            ->setMapping($mapping);

        $indexManager = new IndexManager($this->client);
        $indexManager->create($index);

        $this->assertMappingMatch($mapping->toArray(), $this->getIndexMapping($index->getName()));
    }
}
