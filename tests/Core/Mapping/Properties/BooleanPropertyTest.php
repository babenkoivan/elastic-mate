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
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\BooleanProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 */
final class BooleanPropertyTest extends TestCase
{
    use HasClient, HasMappingAssertions;

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
            ->setNullValue(false)
            ->setBoost(1.1);

        $this->assertSame(
            [
                'type' => 'boolean',
                'boost' => 1.1,
                'doc_values' => true,
                'index' => false,
                'store' => true,
                'null_value' => false
            ],
            $booleanProperty->toArray()
        );
    }

    public function test_boolean_property_can_be_created(): void
    {
        $mapping = (new Mapping())
            ->addProperty(
                new BooleanProperty('foo')
            )
            ->addProperty(
                (new BooleanProperty('bar'))
                    ->setDocValues(true)
                    ->setStore(true)
                    ->setIndex(false)
                    ->setNullValue(false)
                    ->setBoost(1.1)
            );

        $index = (new Index('test'))
            ->setMapping($mapping);

        $indexManager = new IndexManager($this->client);
        $indexManager->create($index);

        $this->assertMappingMatch($mapping->toArray(), $this->getIndexMapping($index->getName()));
    }
}
