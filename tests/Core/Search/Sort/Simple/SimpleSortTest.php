<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Sort\Simple;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort
 * @uses \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort
 */
final class SimpleSortTest extends TestCase
{
    public function test_simple_sort_can_be_converted_to_array(): void
    {
        $simpleSort = new SimpleSort(collect([
            new FieldSort('foo', 'asc'),
            new FieldSort('bar', 'desc')
        ]));

        $this->assertSame(
            [
                ['foo' => 'asc'],
                ['bar' => 'desc'],
            ],
            $simpleSort->toArray()
        );
    }
}
