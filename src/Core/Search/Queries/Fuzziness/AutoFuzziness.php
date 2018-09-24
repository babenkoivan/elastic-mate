<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness;

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
     * @param int $prefixLength
     * @param int $maxExpansions
     */
    public function __construct(
        int $low = 3,
        int $high = 6,
        bool $isTransposable = true,
        int $prefixLength = 0,
        int $maxExpansions = 50
    ) {
        $this->low = $low;
        $this->high = $high;
        $this->isTransposable = $isTransposable;
        $this->prefixLength = $prefixLength;
        $this->maxExpansions = $maxExpansions;
    }

    /**
     * @inheritdoc
     */
    public function getValue(): string
    {
        return sprintf(
            'AUTO:%d,%d',
            $this->low,
            $this->high
        );
    }
}
