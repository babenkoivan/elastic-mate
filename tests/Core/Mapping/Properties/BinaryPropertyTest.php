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
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\BinaryProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 */
final class BinaryPropertyTest extends TestCase
{
    use HasClient, HasMappingAssertions;

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
            ->setStore(true);

        $this->assertSame(
            [
                'type' => 'binary',
                'doc_values' => true,
                'store' => true
            ],
            $binaryProperty->toArray()
        );
    }

    public function test_binary_property_can_be_created(): void
    {
        $mapping = (new Mapping())
            ->addProperty(
                new BinaryProperty('foo')
            )
            ->addProperty(
                (new BinaryProperty('bar'))
                    ->setDocValues(true)
                    ->setStore(true)
            );

        $index = (new Index('test'))
            ->setMapping($mapping);

        $indexManager = new IndexManager($this->client);
        $indexManager->create($index);

        $this->assertMappingMatch($mapping->toArray(), $this->getIndexMapping($index->getName()));
    }
}
