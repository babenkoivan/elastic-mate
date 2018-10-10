<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Pagination
 */
final class PaginationTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [0, 10],
            [999, null],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @testdox Pagination from $from with size $size can be created and properties can be received via getters
     * @param int $from
     * @param int|null $size
     */
    public function test_pagination_can_be_created_and_properties_can_be_received_via_getters(
        int $from,
        ?int $size
    ): void {
        $pagination = new Pagination($from, $size);

        $this->assertSame($from, $pagination->getFrom());
        $this->assertSame($size, $pagination->getSize());
    }
}
