<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Support\Fuzziness;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Support\Fuzziness\AutoFuzziness;
use BabenkoIvan\ElasticMate\Core\Support\Fuzziness\ExactFuzziness;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\MatchQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Support\Fuzziness\AbstractFuzziness
 * @uses   \BabenkoIvan\ElasticMate\Core\Support\Fuzziness\AutoFuzziness
 * @uses   \BabenkoIvan\ElasticMate\Core\Support\Fuzziness\ExactFuzziness
 */
final class MatchQueryTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                'field_1',
                'foo',
                Query::OPERATOR_AND,
                new ExactFuzziness(2, true),
                2,
                10,
                'whitespace',
                0.01,
                true
            ],
            [
                'field_2',
                'bar',
                Query::OPERATOR_OR,
                new AutoFuzziness(5, 8, false),
                0,
                5,
                'standard',
                0.5,
                false
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @testdox Match query "$query" can be converted to array
     * @param string $field
     * @param string $query
     * @param string $operator
     * @param Fuzziness $fuzziness
     * @param int $prefixLength
     * @param int $maxExpansions
     * @param string $analyzer
     * @param float $cutoffFrequency
     * @param bool $isLenient
     */
    public function test_match_query_can_be_converted_to_array(
        string $field,
        string $query,
        string $operator,
        Fuzziness $fuzziness,
        int $prefixLength,
        int $maxExpansions,
        string $analyzer,
        float $cutoffFrequency,
        bool $isLenient
    ): void {
        $matchQuery = (new MatchQuery($field, $query))
            ->setOperator($operator)
            ->setFuzziness($fuzziness)
            ->setPrefixLength($prefixLength)
            ->setMaxExpansions($maxExpansions)
            ->setAnalyzer($analyzer)
            ->setCutoffFrequency($cutoffFrequency)
            ->setLenient($isLenient);

        $this->assertEquals(
            [
                'match' => [
                    $field => [
                        'query' => $query,
                        'operator' => $operator,
                        'fuzziness' => $fuzziness->toString(),
                        'fuzzy_transpositions' => $fuzziness->isTransposable(),
                        'prefix_length' => $prefixLength,
                        'max_expansions' => $maxExpansions,
                        'analyzer' => $analyzer,
                        'lenient' => $isLenient
                    ]
                ]
            ],
            $matchQuery->toArray()
        );
    }
}
