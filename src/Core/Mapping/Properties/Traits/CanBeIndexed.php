<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanBeIndexed
{
    /**
     * @var bool
     */
    private $isIndexed = true;

    /**
     * @param bool $isIndexed
     * @return self
     */
    public function setIndexed(bool $isIndexed): self
    {
        $this->isIndexed = $isIndexed;
        return $this;
    }
}
