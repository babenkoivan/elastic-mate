<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait HasDocValues
{
    /**
     * @var bool
     */
    private $docValues = false;

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
