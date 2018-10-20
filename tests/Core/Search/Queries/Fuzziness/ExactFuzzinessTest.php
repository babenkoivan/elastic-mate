<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\ExactFuzziness
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\AbstractFuzziness
 */
final class ExactFuzzinessTest extends TestCase
{
    public function test_exact_fuzziness_can_be_created_and_converted_to_string(): void
    {
        $exactFuzziness = new ExactFuzziness(3, true);

        $this->assertSame('3', $exactFuzziness->toString());
        $this->assertSame(true, $exactFuzziness->isTransposable());
    }
}
