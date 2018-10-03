<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\DateProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class DatePropertyTest extends TestCase
{
    public function test_date_property_can_be_converted_to_array(): void
    {
        $dateProperty = (new DateProperty('foo'))
            ->setBoost(1.2)
            ->setDocValues(false)
            ->setFormat('yyyy-MM-dd HH:mm:ss')
            ->setLocale('ENGLISH')
            ->setIgnoreMalformed(false)
            ->setIndexed(false)
            ->setNullValue('NULL')
            ->setStored(true);

        $this->assertSame(
            [
                'type' => 'date',
                'boost' => 1.2,
                'doc_values' => false,
                'format' => 'yyyy-MM-dd HH:mm:ss',
                'locale' => 'ENGLISH',
                'ignore_malformed' => false,
                'index' => false,
                'null_value' => 'NULL',
                'store' => true
            ],
            $dateProperty->toArray()
        );
    }
}
