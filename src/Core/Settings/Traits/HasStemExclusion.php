<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

use Illuminate\Support\Collection;

trait HasStemExclusion
{
    /**
     * @var Collection|null
     */
    protected $stemExclusion;

    /**
     * @param string $word
     * @return HasStemExclusion
     */
    public function addStemExclusion(string $word): self
    {
        if (!isset($this->stemExclusion)) {
            $this->stemExclusion = collect();
        }

        $this->stemExclusion->push(strtolower($word));
        return $this;
    }
}
