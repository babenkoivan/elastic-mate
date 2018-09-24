<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Fuzziness;

abstract class AbstractFuzziness implements Fuzziness
{
    /**
     * @var bool
     */
    protected $isTransposable;

    /**
     * @var int
     */
    protected $prefixLength;

    /**
     * @var int
     */
    protected $maxExpansions;

    /**
     * @return bool
     */
    public function isTransposable(): bool
    {
        return $this->isTransposable;
    }

    /**
     * @return int
     */
    public function getPrefixLength(): int
    {
        return $this->prefixLength;
    }

    /**
     * @return int
     */
    public function getMaxExpansions(): int
    {
        return $this->maxExpansions;
    }

    /**
     * @inheritdoc
     */
    abstract public function getValue(): string;
}
