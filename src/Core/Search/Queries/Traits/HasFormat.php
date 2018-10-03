<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

trait HasFormat
{
    /**
     * @var string|null
     */
    private $format;

    /**
     * @param string $format
     * @return self
     */
    public function setFormat(string $format): self
    {
        $this->format = $format;
        return $this;
    }
}
