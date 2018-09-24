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
    public function test_exact_fuzziness_can_be_created_and_properties_can_be_received_via_getters(): void
    {
        $exactFuzziness = new ExactFuzziness(3, true, 1, 40);

        $this->assertSame('3', $exactFuzziness->getValue());
        $this->assertSame(true, $exactFuzziness->isTransposable());
        $this->assertSame(1, $exactFuzziness->getPrefixLength());
        $this->assertSame(40, $exactFuzziness->getMaxExpansions());
    }
}
