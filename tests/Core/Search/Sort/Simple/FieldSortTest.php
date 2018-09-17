<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Sort\Simple;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort
 */
class FieldSortTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            ['foo', 'asc'],
            ['foo', 'bar'],
            ['bar', 'desc'],
            ['bar', 'DESC'],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @testdox Field sort "$field" with order "$order" can be converted to array
     * @param string $field
     * @param string $order
     */
    public function test_field_sort_can_be_converted_to_array(string $field, string $order): void
    {
        $lowercasedOrder = strtolower($order);

        if (!in_array($lowercasedOrder, [FieldSort::ORDER_ASC, FieldSort::ORDER_DESC])) {
            $this->expectExceptionMessage('Unsupported order type ' . $lowercasedOrder);
        }

        $this->assertSame(
            [$field => $lowercasedOrder],
            (new FieldSort($field, $order))->toArray()
        );
    }
}
