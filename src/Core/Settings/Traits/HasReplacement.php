<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait HasReplacement
{
    /**
     * @var string
     */
    private $replacement;

    /**
     * @param string $replacement
     * @return self
     */
    public function setReplacement(string $replacement): self
    {
        $this->replacement = $replacement;
        return $this;
    }
}
