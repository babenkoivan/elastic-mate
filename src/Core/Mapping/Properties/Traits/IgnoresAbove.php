<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait IgnoresAbove
{
    /**
     * @var int
     */
    private $ignoreAbove = 2147483647;

    /**
     * @param int $ignoreAbove
     * @return self
     */
    public function setIgnoreAbove(int $ignoreAbove): self
    {
        $this->ignoreAbove = $ignoreAbove;
        return $this;
    }
}
