<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanUseDocValues
{
    /**
     * @var bool
     */
    private $docValues = true;

    /**
     * @param bool $docValues
     * @return self
     */
    public function setDocValues(bool $docValues): self
    {
        $this->docValues = $docValues;
        return $this;
    }
}
