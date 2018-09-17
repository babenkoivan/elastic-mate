<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search;

use BabenkoIvan\ElasticMate\Core\Search\Queries\MatchAllQuery;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Request
 * @uses \BabenkoIvan\ElasticMate\Core\Search\Queries\MatchAllQuery
 * @uses \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort
 * @uses \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort
 * @uses \BabenkoIvan\ElasticMate\Core\Search\Pagination
 */
class RequestTest extends TestCase
{
    public function test_request_with_query_can_be_created_and_converted_to_array(): void
    {
        $query = new MatchAllQuery();

        $this->assertEquals(
            [
                'query' => $query->toArray()
            ],
            (new Request($query))->toArray()
        );
    }

    public function test_request_with_query_and_sort_can_be_created_and_converted_to_array(): void
    {
        $query = new MatchAllQuery();

        $sort = (new SimpleSort())
            ->addFieldSort(new FieldSort('foo', 'asc'))
            ->addFieldSort(new FieldSort('bar', 'desc'));

        $this->assertEquals(
            [
                'query' => $query->toArray(),
                'sort' => $sort->toArray()
            ],
            (new Request($query, $sort))->toArray()
        );
    }

    /**
     * @testdox Request with query, sort and pagination can be created and converted to array
     */
    public function test_request_with_query_sort_and_pagination_can_be_created_and_converted_to_array(): void
    {
        $query = new MatchAllQuery();

        $sort = (new SimpleSort())
            ->addFieldSort(new FieldSort('foo', 'asc'))
            ->addFieldSort(new FieldSort('bar', 'desc'));

        $pagination = new Pagination(0, 100);

        $this->assertEquals(
            [
                'query' => $query->toArray(),
                'sort' => $sort->toArray(),
                'from' => $pagination->getFrom(),
                'size' => $pagination->getSize()
            ],
            (new Request($query, $sort, $pagination))->toArray()
        );
    }
}
