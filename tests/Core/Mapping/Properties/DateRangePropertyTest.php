<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\DateRangeProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractRangeProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class DateRangePropertyTest extends TestCase
{
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
                'doc_values' => true,
                'format' => 'strict_date_optional_time||epoch_millis',
                'locale' => Mapping::LOCALE_ROOT,
                'ignore_malformed' => false,
                'null_value' => null
            ],
            $property->toArray()
        );
    }

    public function test_date_range_property_can_be_converted_to_array(): void
    {
        $property = (new DateRangeProperty('foo'))
            ->setCoerced(false)
            ->setBoost(1.2)
            ->setIndexed(false)
            ->setStored(true)
            ->setDocValues(false)
            ->setFormat('yyyy-MM-dd HH:mm:ss')
            ->setLocale('ENGLISH')
            ->setIgnoreMalformed(true)
            ->setNullValue('NULL');

        $this->assertSame(
            [
                'type' => 'date_range',
                'coerce' => false,
                'boost' => 1.2,
                'index' => false,
                'store' => true,
                'doc_values' => false,
                'format' => 'yyyy-MM-dd HH:mm:ss',
                'locale' => 'ENGLISH',
                'ignore_malformed' => true,
                'null_value' => 'NULL'
            ],
            $property->toArray()
        );
    }
}
