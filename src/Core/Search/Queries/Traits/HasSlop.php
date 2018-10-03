<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

trait HasSlop
{
    /**
     * @var int
     */
    private $slop = 0;

    /**
     * @param int $slop
     * @return self
     */
    public function setSlop(int $slop): self
    {
        $this->slop = $slop;
        return $this;
    }
}
