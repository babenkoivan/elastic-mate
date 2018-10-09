<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

use Illuminate\Support\Collection;

trait HasFlags
{
    /**
     * @var Collection|null
     */
    private $flags;

    /**
     * @param string $flag
     * @return self
     */
    public function addFlag(string $flag): self
    {
        if (!isset($this->flags)) {
            $this->flags = collect();
        }

        $this->flags->push($flag);
        return $this;
    }
}
