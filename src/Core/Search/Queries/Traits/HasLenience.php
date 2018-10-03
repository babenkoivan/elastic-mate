<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

trait HasLenience
{
    /**
     * @var bool
     */
    private $isLenient = false;

    /**
     * @param bool $isLenient
     * @return self
     */
    public function setLenience(bool $isLenient): self
    {
        $this->isLenient = $isLenient;
        return $this;
    }
}
