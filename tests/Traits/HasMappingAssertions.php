<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Traits;

trait HasMappingAssertions
{
    /**
     * @param array $expected
     * @param array $actual
     */
    public function assertMappingMatch(array $expected, array $actual): void
    {
        foreach ($expected['properties'] as $field => $expectedOptions) {
            $actualOptions = $actual['properties'][$field];

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
