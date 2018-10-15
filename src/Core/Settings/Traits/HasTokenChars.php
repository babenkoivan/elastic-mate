<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

use Illuminate\Support\Collection;

trait HasTokenChars
{
    /**
     * @var Collection
     */
    private $tokenChars;

    /**
     * @param string $charGroup
     * @return self
     */
    public function addTokenChars(string $charGroup): self
    {
        if (!isset($this->tokenChars)) {
            $this->tokenChars = collect();
        }

        $this->tokenChars->push($charGroup);
        return $this;
    }
}
