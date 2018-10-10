<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait HasMaxOutputSize
{
    /**
     * @var int
     */
    private $maxOutputSize = 255;

    /**
     * @param int $maxOutputSize
     * @return self
     */
    public function setMaxOutputSize(int $maxOutputSize): self
    {
        $this->maxOutputSize = $maxOutputSize;
        return $this;
    }
}
