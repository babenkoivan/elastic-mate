<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait HasNullValue
{
    /**
     * @var mixed
     */
    private $nullValue = null;

    /**
     * @param mixed $nullValue
     * @return self
     */
    public function setNullValue($nullValue): self
    {
        $this->nullValue = $nullValue;
        return $this;
    }
}
