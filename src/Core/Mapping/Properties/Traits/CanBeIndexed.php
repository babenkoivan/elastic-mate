<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanBeIndexed
{
    /**
     * @var bool
     */
    private $index = true;

    /**
     * @param bool $index
     * @return self
     */
    public function setIndex(bool $index): self
    {
        $this->index = $index;
        return $this;
    }
}
