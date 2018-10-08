<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait HasMaxTokenLength
{
    /**
     * @var int
     */
    private $maxTokenLength = 255;

    /**
     * @param int $maxTokenLength
     * @return self
     */
    public function setMaxTokenLength(int $maxTokenLength): self
    {
        $this->maxTokenLength = $maxTokenLength;
        return $this;
    }
}
