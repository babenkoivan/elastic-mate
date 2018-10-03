<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanSplitQueriesOnWhitespace
{
    /**
     * @var bool
     */
    private $splitQueriesOnWhitespace = false;

    /**
     * @param bool $splitQueriesOnWhitespace
     * @return self
     */
    public function setSplitQueriesOnWhitespace(bool $splitQueriesOnWhitespace): self
    {
        $this->splitQueriesOnWhitespace = $splitQueriesOnWhitespace;
        return $this;
    }
}
