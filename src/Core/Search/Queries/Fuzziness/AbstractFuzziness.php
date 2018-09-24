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
     * @return bool
     */
    public function isTransposable(): bool
    {
        return $this->isTransposable;
    }

    /**
     * @inheritdoc
     */
    abstract public function getValue(): string;
}
