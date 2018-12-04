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
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\DateProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 */
final class DatePropertyTest extends TestCase
{
    use HasClient, HasMappingAssertions;

    public function test_date_property_has_correct_default_values(): void
    {
        $property = new DateProperty('foo');

        $this->assertSame(
            [
                'type' => 'date',
                'boost' => 1,
                'doc_values' => true,
                'format' => 'strict_date_optional_time||epoch_millis',
                'locale' => Mapping::LOCALE_ROOT,
                'ignore_malformed' => false,
                'index' => true,
                'store' => false
            ],
            $property->toArray()
        );
    }

    public function test_date_property_can_be_converted_to_array(): void
    {
        $property = (new DateProperty('foo'))
            ->setBoost(1.2)
            ->setDocValues(false)
            ->setFormat('yyyy-MM-dd HH:mm:ss')
            ->setLocale('en')
            ->setIgnoreMalformed(true)
            ->setIndex(false)
            ->setNullValue('2000-01-01 00:00:00')
            ->setStore(true);

        $this->assertSame(
            [
                'type' => 'date',
                'boost' => 1.2,
                'doc_values' => false,
                'format' => 'yyyy-MM-dd HH:mm:ss',
                'locale' => 'en',
                'ignore_malformed' => true,
                'index' => false,
                'store' => true,
                'null_value' => '2000-01-01 00:00:00'
            ],
            $property->toArray()
        );
    }

    public function test_date_property_can_be_created(): void
    {
        $mapping = (new Mapping())
            ->addProperty(
                new DateProperty('foo')
            )
            ->addProperty(
                (new DateProperty('bar'))
                    ->setBoost(1.2)
                    ->setDocValues(false)
                    ->setFormat('yyyy-MM-dd HH:mm:ss')
                    ->setLocale('en')
                    ->setIgnoreMalformed(true)
                    ->setIndex(false)
                    ->setNullValue('2000-01-01 00:00:00')
                    ->setStore(true)
            );

        $index = (new Index('test'))
            ->setMapping($mapping);

        $indexManager = new IndexManager($this->client);
        $indexManager->create($index);

        $this->assertMappingMatch($mapping->toArray(), $this->getIndexMapping($index->getName()));
    }
}
