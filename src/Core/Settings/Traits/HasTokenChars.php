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
     * @param string $charClass
     * @return self
     */
    public function addTokenChars(string $charClass): self
    {
        if (!isset($this->tokenChars)) {
            $this->tokenChars = collect();
        }

        $this->tokenChars->push($charClass);
        return $this;
    }
}
