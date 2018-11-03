<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanBeCoerced
{
    /**
     * @var bool
     */
    private $isCoerced = true;

    /**
     * @param bool $isCoerced
     * @return self
     */
    public function setCoerced(bool $isCoerced): self
    {
        $this->isCoerced = $isCoerced;
        return $this;
    }
}
