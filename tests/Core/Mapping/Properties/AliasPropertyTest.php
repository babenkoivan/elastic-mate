<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Traits\HasClient;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AliasProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 */
final class AliasPropertyTest extends TestCase
{
    use HasClient;

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

    public function test_alias_property_can_be_created(): void
    {
        $mapping = (new Mapping())
            ->addProperty(new TextProperty('foo'))
            ->addProperty(new AliasProperty('bar', 'foo'));

        $index = (new Index('test'))
            ->setMapping($mapping);

        $indexManager = new IndexManager($this->client);
        $indexManager->create($index);

        $expectedMapping = $mapping->toArray();
        $actualMapping = $this->getIndexMapping($index->getName());

        foreach ($expectedMapping['properties'] as $field => $expectedOptions) {
            $actualOptions = $actualMapping['properties'][$field];

            $this->assertEquals(
                array_only(
                    $expectedOptions,
                    array_keys($actualOptions)
                ),
                $actualOptions
            );
        }
    }
}
