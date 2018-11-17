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
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\IpProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 */
final class IpPropertyTest extends TestCase
{
    use HasClient, HasMappingAssertions;

    public function test_ip_property_has_correct_default_values(): void
    {
        $ipProperty = new IpProperty('foo');

        $this->assertSame(
            [
                'type' => 'ip',
                'boost' => 1,
                'doc_values' => true,
                'index' => true,
                'store' => false
            ],
            $ipProperty->toArray()
        );
    }

    public function test_ip_property_can_be_converted_to_array(): void
    {
        $ipProperty = (new IpProperty('foo'))
            ->setDocValues(false)
            ->setStore(false)
            ->setIndex(true)
            ->setNullValue('0.0.0.0')
            ->setBoost(1.2);

        $this->assertSame(
            [
                'type' => 'ip',
                'boost' => 1.2,
                'doc_values' => false,
                'index' => true,
                'store' => false,
                'null_value' => '0.0.0.0'
            ],
            $ipProperty->toArray()
        );
    }

    public function test_ip_property_can_be_created(): void
    {
        $mapping = (new Mapping())
            ->addProperty(
                new IpProperty('foo')
            )
            ->addProperty(
                (new IpProperty('bar'))
                    ->setDocValues(false)
                    ->setStore(false)
                    ->setIndex(true)
                    ->setNullValue('0.0.0.0')
                    ->setBoost(1.2)
            );

        $index = (new Index('test'))
            ->setMapping($mapping);

        $indexManager = new IndexManager($this->client);
        $indexManager->create($index);

        $this->assertMappingMatch($mapping->toArray(), $this->getIndexMapping($index->getName()));
    }
}
