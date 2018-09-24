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
     */
    public function __construct(
        int $edits,
        bool $isTransposable = true
    ) {
        $this->edits = $edits;
        $this->isTransposable = $isTransposable;
    }

    /**
     * @inheritdoc
     */
    public function getValue(): string
    {
        return (string)$this->edits;
    }
}
