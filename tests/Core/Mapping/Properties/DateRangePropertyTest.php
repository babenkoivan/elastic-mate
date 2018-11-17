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
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\DateRangeProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractRangeProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Client
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory
 * @uses   \BabenkoIvan\ElasticMate\Infrastructure\Client\Namespaces\IndicesNamespace
 * @uses   \BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Index
 */
final class DateRangePropertyTest extends TestCase
{
    use HasClient, HasMappingAssertions;

    public function test_date_range_property_has_correct_default_values(): void
    {
        $property = new DateRangeProperty('foo');

        $this->assertSame(
            [
                'type' => 'date_range',
                'coerce' => true,
                'boost' => 1,
                'index' => true,
                'store' => false,
                'format' => 'strict_date_optional_time||epoch_millis',
                'locale' => Mapping::LOCALE_ROOT
            ],
            $property->toArray()
        );
    }

    public function test_date_range_property_can_be_converted_to_array(): void
    {
        $property = (new DateRangeProperty('foo'))
            ->setCoerce(false)
            ->setBoost(1.2)
            ->setIndex(false)
            ->setStore(true)
            ->setFormat('yyyy-MM-dd HH:mm:ss')
            ->setLocale('en');

        $this->assertSame(
            [
                'type' => 'date_range',
                'coerce' => false,
                'boost' => 1.2,
                'index' => false,
                'store' => true,
                'format' => 'yyyy-MM-dd HH:mm:ss',
                'locale' => 'en'
            ],
            $property->toArray()
        );
    }

    public function test_date_range_property_can_be_created(): void
    {
        $mapping = (new Mapping())
            ->addProperty(
                new DateRangeProperty('foo')
            )
            ->addProperty(
                (new DateRangeProperty('bar'))
                    ->setCoerce(false)
                    ->setBoost(1.2)
                    ->setIndex(false)
                    ->setStore(true)
                    ->setFormat('yyyy-MM-dd HH:mm:ss')
                    ->setLocale('en')
            );

        $index = (new Index('test'))
            ->setMapping($mapping);

        $indexManager = new IndexManager($this->client);
        $indexManager->create($index);

        $this->assertMappingMatch($mapping->toArray(), $this->getIndexMapping($index->getName()));
    }
}
