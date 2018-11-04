<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanUseFieldData
{
    /**
     * @var bool
     */
    private $fieldData = false;

    /**
     * @param bool $fieldData
     * @return self
     */
    public function setFieldData(bool $fieldData): self
    {
        $this->fieldData = $fieldData;
        return $this;
    }
}
