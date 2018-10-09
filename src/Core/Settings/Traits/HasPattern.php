<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait HasPattern
{
    /**
     * @var string
     */
    private $pattern = '\W+';

    /**
     * @param string $pattern
     * @return self
     */
    public function setPattern(string $pattern): self
    {
        $this->pattern = $pattern;
        return $this;
    }
}
