<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness;

final class ExactFuzziness extends AbstractFuzziness
{
    /**
     * @var int
     */
    private $edits;

    /**
     * @param int $edits
     * @param bool $isTransposable
     * @param int $prefixLength
     * @param int $maxExpansions
     */
    public function __construct(
        int $edits,
        bool $isTransposable = true,
        int $prefixLength = 0,
        int $maxExpansions = 50
    ) {
        $this->edits = $edits;
        $this->isTransposable = $isTransposable;
        $this->prefixLength = $prefixLength;
        $this->maxExpansions = $maxExpansions;
    }

    /**
     * @inheritdoc
     */
    public function getValue(): string
    {
        return (string)$this->edits;
    }
}
