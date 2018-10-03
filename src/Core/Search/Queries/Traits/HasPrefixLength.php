<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

trait HasPrefixLength
{
    /**
     * @var int
     */
    private $prefixLength = 0;

    /**
     * @param int $prefixLength
     * @return self
     */
    public function setPrefixLength(int $prefixLength): self
    {
        $this->prefixLength = $prefixLength;
        return $this;
    }
}
