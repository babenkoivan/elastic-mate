<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search;

use BabenkoIvan\ElasticMate\Core\Search\Queries\MatchAllQuery;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Request
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\MatchAllQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Pagination
 */
class RequestTest extends TestCase
{
    public function test_request_with_query_can_be_created_and_converted_to_array(): void
    {
        $query = new MatchAllQuery();
        $request = new Request($query);

        $this->assertEquals(
            [
                'query' => $query->toArray()
            ],
            $request->toArray()
        );
    }

    public function test_request_with_query_and_sort_can_be_created_and_converted_to_array(): void
    {
        $query = new MatchAllQuery();

        $sort = new SimpleSort(collect([
            new FieldSort('foo', 'asc'),
            new FieldSort('bar', 'desc')
        ]));

        $request = (new Request($query))->setSort($sort);

        $this->assertEquals(
            [
                'query' => $query->toArray(),
                'sort' => $sort->toArray()
            ],
            $request->toArray()
        );
    }

    /**
     * @testdox Request with query, sort and pagination can be created and converted to array
     */
    public function test_request_with_query_sort_and_pagination_can_be_created_and_converted_to_array(): void
    {
        $query = new MatchAllQuery();

        $sort = new SimpleSort(collect([
            new FieldSort('foo', 'asc'),
            new FieldSort('bar', 'desc')
        ]));

        $pagination = new Pagination(0, 100);

        $request = (new Request($query))
            ->setSort($sort)
            ->setPagination($pagination);

        $this->assertEquals(
            [
                'query' => $query->toArray(),
                'sort' => $sort->toArray(),
                'from' => $pagination->getFrom(),
                'size' => $pagination->getSize()
            ],
            $request->toArray()
        );
    }
}
