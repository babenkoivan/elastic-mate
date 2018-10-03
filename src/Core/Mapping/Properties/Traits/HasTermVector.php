<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;

trait HasTermVector
{
    /**
     * @var string
     */
    private $termVector = Property::TERM_VECTOR_NO;

    /**
     * @param string $termVector
     * @return self
     */
    public function setTermVector(string $termVector): self
    {
        $this->termVector = $termVector;
        return $this;
    }
}
