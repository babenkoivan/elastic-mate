<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;

trait HasTermVector
{
    /**
     * @var string
     */
    private $termVector = Mapping::TERM_VECTOR_NO;

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
