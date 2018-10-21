<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\CanOutputUnigrams;

final class ShingleTokenFilter extends AbstractTokenFilter
{
    use CanOutputUnigrams;

    /**
     * @var int
     */
    private $maxShingleSize = 2;

    /**
     * @var int
     */
    private $minShingleSize = 2;

    /**
     * @var bool
     */
    private $outputUnigramsIfNoShingles = false;

    /**
     * @var string
     */
    private $tokenSeparator = ' ';

    /**
     * @var string
     */
    private $fillerToken = '_';

    /**
     * @param int $maxShingleSize
     * @return self
     */
    public function setMaxShingleSize(int $maxShingleSize): self
    {
        $this->maxShingleSize = $maxShingleSize;
        return $this;
    }

    /**
     * @param int $minShingleSize
     * @return self
     */
    public function setMinShingleSize(int $minShingleSize): self
    {
        $this->minShingleSize = $minShingleSize;
        return $this;
    }

    /**
     * @param bool $outputUnigramsIfNoShingles
     * @return self
     */
    public function setOutputUnigramsIfNoShingles(bool $outputUnigramsIfNoShingles): self
    {
        $this->outputUnigramsIfNoShingles = $outputUnigramsIfNoShingles;
        return $this;
    }

    /**
     * @param string $tokenSeparator
     * @return self
     */
    public function setTokenSeparator(string $tokenSeparator): self
    {
        $this->tokenSeparator = $tokenSeparator;
        return $this;
    }

    /**
     * @param string $fillerToken
     * @return self
     */
    public function setFillerToken(string $fillerToken): self
    {
        $this->fillerToken = $fillerToken;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_SHINGLE,
            'max_shingle_size' => $this->maxShingleSize,
            'min_shingle_size' => $this->minShingleSize,
            'output_unigrams' => $this->outputUnigrams,
            'output_unigrams_if_no_shingles' => $this->outputUnigramsIfNoShingles,
            'token_separator' => $this->tokenSeparator,
            'filler_token' => $this->fillerToken
        ];
    }
}
