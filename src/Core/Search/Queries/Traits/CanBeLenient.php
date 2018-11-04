<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

trait CanBeLenient
{
    /**
     * @var bool
     */
    private $lenient = false;

    /**
     * @param bool $lenient
     * @return self
     */
    public function setLenient(bool $lenient): self
    {
        $this->lenient = $lenient;
        return $this;
    }
}
