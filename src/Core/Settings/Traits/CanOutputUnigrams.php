<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait CanOutputUnigrams
{
    /**
     * @var bool
     */
    private $outputUnigrams = true;

    /**
     * @param bool $outputUnigrams
     * @return self
     */
    public function setOutputUnigrams(bool $outputUnigrams): self
    {
        $this->outputUnigrams = $outputUnigrams;
        return $this;
    }
}
