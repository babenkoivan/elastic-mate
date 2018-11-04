<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\DateProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class DatePropertyTest extends TestCase
{
    public function test_date_property_has_correct_default_values(): void
    {
        $dateProperty = new DateProperty('foo');

        $this->assertSame(
            [
                'type' => 'date',
                'boost' => 1,
                'doc_values' => true,
                'format' => 'strict_date_optional_time||epoch_millis',
                'locale' => Mapping::LOCALE_ROOT,
                'ignore_malformed' => false,
                'index' => true,
                'null_value' => null,
                'store' => false
            ],
            $dateProperty->toArray()
        );
    }

    public function test_date_property_can_be_converted_to_array(): void
    {
        $dateProperty = (new DateProperty('foo'))
            ->setBoost(1.2)
            ->setDocValues(false)
            ->setFormat('yyyy-MM-dd HH:mm:ss')
            ->setLocale('ENGLISH')
            ->setIgnoreMalformed(true)
            ->setIndex(false)
            ->setNullValue('NULL')
            ->setStore(true);

        $this->assertSame(
            [
                'type' => 'date',
                'boost' => 1.2,
                'doc_values' => false,
                'format' => 'yyyy-MM-dd HH:mm:ss',
                'locale' => 'ENGLISH',
                'ignore_malformed' => true,
                'index' => false,
                'null_value' => 'NULL',
                'store' => true
            ],
            $dateProperty->toArray()
        );
    }
}
