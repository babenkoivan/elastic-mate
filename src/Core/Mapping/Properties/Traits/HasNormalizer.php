<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait HasNormalizer
{
    /**
     * @var string|null
     */
    private $normalizer = null;

    /**
     * @param string|null $normalizer
     * @return self
     */
    public function setNormalizer(?string $normalizer): self
    {
        $this->normalizer = $normalizer;
        return $this;
    }

}
