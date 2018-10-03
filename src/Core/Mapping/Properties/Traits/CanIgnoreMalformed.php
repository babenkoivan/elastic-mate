<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanIgnoreMalformed
{
    /**
     * @var bool
     */
    private $ignoreMalformed = true;

    /**
     * @param bool $ignoreMalformed
     * @return self
     */
    public function setIgnoreMalformed(bool $ignoreMalformed): self
    {
        $this->ignoreMalformed = $ignoreMalformed;
        return $this;
    }
}
