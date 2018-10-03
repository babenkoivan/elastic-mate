<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\IpProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class IpPropertyTest extends TestCase
{
    public function test_ip_property_can_be_converted_to_array(): void
    {
        $ipProperty = (new IpProperty('foo'))
            ->setDocValues(false)
            ->setStored(false)
            ->setIndexed(true)
            ->setNullValue('NULL')
            ->setBoost(1.2);

        $this->assertSame(
            [
                'type' => 'ip',
                'doc_values' => false,
                'store' => false,
                'index' => true,
                'null_value' => 'NULL',
                'boost' => 1.2
            ],
            $ipProperty->toArray()
        );
    }
}
