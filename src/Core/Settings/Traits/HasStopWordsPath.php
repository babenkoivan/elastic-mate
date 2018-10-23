<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait HasStopWordsPath
{
    /**
     * @var string
     */
    private $stopWordsPath;

    /**
     * @param string $stopWordsPath
     * @return self
     */
    public function setStopWordsPath(string $stopWordsPath): self
    {
        $this->stopWordsPath = $stopWordsPath;
        return $this;
    }
}
