<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\AutoFuzziness;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\FuzzyQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\AbstractFuzziness
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\AutoFuzziness
 */
final class FuzzyQueryTest extends TestCase
{
    public function test_fuzzy_query_can_be_converted_to_array(): void
    {
        $fuzzyQuery = (new FuzzyQuery('foo', 'bar'))
            ->setFuzziness(new AutoFuzziness(2, 7, true))
            ->setPrefixLength(1)
            ->setMaxExpansions(40)
            ->setBoost(1.2);

        $this->assertSame(
            [
                'fuzzy' => [
                    'foo' => [
                        'value' => 'bar',
                        'prefix_length' => 1,
                        'max_expansions' => 40,
                        'fuzziness' => 'AUTO:2,7',
                        'transpositions' => true,
                        'boost' => 1.2
                    ]
                ]
            ],
            $fuzzyQuery->toArray()
        );
    }
}
