<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Support\Fuzziness;

final class AutoFuzziness extends AbstractFuzziness
{
    /**
     * @var int
     */
    private $low;

    /**
     * @var int
     */
    private $high;

    /**
     * @param int $low
     * @param int $high
     * @param bool $isTransposable
     */
    public function __construct(
        int $low = 3,
        int $high = 6,
        bool $isTransposable = true
    ) {
        $this->low = $low;
        $this->high = $high;
        $this->isTransposable = $isTransposable;
    }

    /**
     * @inheritdoc
     */
    public function toString(): string
    {
        return sprintf(
            'AUTO:%d,%d',
            $this->low,
            $this->high
        );
    }
}
