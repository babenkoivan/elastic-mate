<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Traits;

trait HasSettingsAssertions
{
    /**
     * @param array $expected
     * @param array $actual
     */
    public function assertSettingsMatch(array $expected, array $actual): void
    {
        $this->assertEquals(
            $expected,
            array_only(
                $actual,
                array_keys($expected)
            )
        );
    }
}
