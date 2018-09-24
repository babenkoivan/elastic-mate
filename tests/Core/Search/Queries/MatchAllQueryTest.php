<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\MatchAllQuery
 */
final class MatchAllQueryTest extends TestCase
{
    public function test_match_all_query_can_be_converted_to_array(): void
    {
        $matchAllQuery = new MatchAllQuery();

        $this->assertEquals(
            [
                'match_all' => new stdClass()
            ],
            $matchAllQuery->toArray()
        );
    }
}
