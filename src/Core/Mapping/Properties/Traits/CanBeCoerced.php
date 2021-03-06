<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanBeCoerced
{
    /**
     * @var bool
     */
    private $coerce = true;

    /**
     * @param bool $coerce
     * @return self
     */
    public function setCoerce(bool $coerce): self
    {
        $this->coerce = $coerce;
        return $this;
    }
}
