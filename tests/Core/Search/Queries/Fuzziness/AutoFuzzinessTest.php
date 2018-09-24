<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\AutoFuzziness
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\AbstractFuzziness
 */
final class AutoFuzzinessTest extends TestCase
{
    public function test_auto_fuzziness_can_be_created_and_properties_can_be_received_via_getters(): void
    {
        $autoFuzziness = new AutoFuzziness(5, 10, false);

        $this->assertSame('AUTO:5,10', $autoFuzziness->getValue());
        $this->assertSame(false, $autoFuzziness->isTransposable());
    }
}
