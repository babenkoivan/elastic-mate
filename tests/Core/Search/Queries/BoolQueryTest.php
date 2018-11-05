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
    public function test_bool_query_can_be_converted_to_array(): void
    {
        $mustQuery = new TermQuery('field1', 'foo');
        $mustNotQuery = new TermQuery('field3', 'bar');
        $firstShouldQuery = new RegexpQuery('field4', 't.*t');
        $secondShouldQuery = new WildcardQuery('field4', 't***t');
        $filterQuery = (new BoolQuery())->addMustNot(new ExistsQuery('field2'));
        $minimumShouldMatch = 2;
        $boost = 1.9;

        $boolQuery = (new BoolQuery())
            ->addMust($mustQuery)
            ->addMustNot($mustNotQuery)
            ->addShould($firstShouldQuery)
            ->addShould($secondShouldQuery)
            ->addFilter($filterQuery)
            ->setMinimumShouldMatch($minimumShouldMatch)
            ->setBoost($boost);

        $this->assertSame(
            [
                'bool' => [
                    'must' => [
                        $mustQuery->toArray()
                    ],
                    'must_not' => [
                        $mustNotQuery->toArray()
                    ],
                    'should' => [
                        $firstShouldQuery->toArray(),
                        $secondShouldQuery->toArray()
                    ],
                    'filter' => [
                        $filterQuery->toArray()
                    ],
                    'minimum_should_match' => $minimumShouldMatch,
                    'boost' => $boost
                ]
            ],
            $boolQuery->toArray()
        );
    }
}
