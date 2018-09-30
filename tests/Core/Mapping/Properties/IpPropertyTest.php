<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\IpProperty
 */
final class IpPropertyTest extends TestCase
{
    public function test_ip_property_can_be_converted_to_array(): void
    {
        $ipProperty = new IpProperty('foo', false, false, true, 'NULL', 1.2);

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
