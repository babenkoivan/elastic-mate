<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanEagerGlobalOrdinals
{
    /**
     * @var bool
     */
    private $eagerGlobalOrdinals = false;

    /**
     * @param bool $eagerGlobalOrdinals
     * @return self
     */
    public function setEagerGlobalOrdinals(bool $eagerGlobalOrdinals): self
    {
        $this->eagerGlobalOrdinals = $eagerGlobalOrdinals;
        return $this;
    }
}
