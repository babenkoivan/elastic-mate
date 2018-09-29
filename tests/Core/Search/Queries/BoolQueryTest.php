<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\BoolQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\ExistsQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\TermQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\RegexpQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\WildcardQuery
 */
final class BoolQueryTest extends TestCase
{
    public function test_bool_query_creation_without_boolean_clauses_causes_error(): void
    {
        $this->expectExceptionMessage(
            'At least one of the boolean clauses must be used: must, filter, must not, should'
        );

        new BoolQuery();
    }

    public function test_bool_query_can_be_converted_to_array(): void
    {
        $must = new TermQuery('field1', 'foo');
        $filter = new BoolQuery(null, null, new ExistsQuery('field2'));
        $mustNot = new TermQuery('field3', 'bar');
        $should = collect([new RegexpQuery('field4', 't.*t'), new WildcardQuery('field4', 't***t')]);
        $minimumShouldMatch = 2;
        $boost = 1.9;

        $boolQuery = new BoolQuery($must, $filter, $mustNot, $should, $minimumShouldMatch, $boost);

        $this->assertSame(
            [
                'bool' => [
                    'must' => $must->toArray(),
                    'filter' => $filter->toArray(),
                    'must_not' => $mustNot->toArray(),
                    'should' => $should->map(function (Query $query) {
                        return $query->toArray();
                    })->all(),
                    'minimum_should_match' => $minimumShouldMatch,
                    'boost' => $boost
                ]
            ],
            $boolQuery->toArray()
        );
    }
}
