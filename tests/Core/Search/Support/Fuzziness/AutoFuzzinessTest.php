<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Support\Fuzziness;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Support\Fuzziness\AutoFuzziness
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Support\Fuzziness\AbstractFuzziness
 */
final class AutoFuzzinessTest extends TestCase
{
    public function test_auto_fuzziness_can_be_created_and_converted_to_string(): void
    {
        $autoFuzziness = new AutoFuzziness(5, 10, false);

        $this->assertSame('AUTO:5,10', $autoFuzziness->toString());
        $this->assertSame(false, $autoFuzziness->isTransposable());
    }
}
