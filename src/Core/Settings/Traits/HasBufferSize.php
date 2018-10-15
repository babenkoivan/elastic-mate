<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait HasBufferSize
{
    /**
     * @var int
     */
    private $bufferSize = 256;

    /**
     * @param int $bufferSize
     * @return self
     */
    public function setBufferSize(int $bufferSize): self
    {
        $this->bufferSize = $bufferSize;
        return $this;
    }
}
