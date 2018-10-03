<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait HasStore
{
    /**
     * @var bool
     */
    private $store;

    /**
     * @param bool $store
     * @return self
     */
    public function setStore(bool $store): self
    {
        $this->store = $store;
        return $this;
    }
}
