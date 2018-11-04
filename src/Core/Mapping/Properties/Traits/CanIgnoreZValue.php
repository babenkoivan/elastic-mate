<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanIgnoreZValue
{
    /**
     * @var bool
     */
    private $ignoreZValue = true;

    /**
     * @param bool $ignoreZValue
     * @return self
     */
    public function setIgnoreZValue(bool $ignoreZValue): self
    {
        $this->ignoreZValue = $ignoreZValue;
        return $this;
    }
}
