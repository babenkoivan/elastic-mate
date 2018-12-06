<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use Illuminate\Support\Collection;

final class CustomAnalyzer extends AbstractAnalyzer
{
    /**
     * @var string
     */
    private $tokenizer = Tokenizer::TYPE_STANDARD;

    /**
     * @var Collection
     */
    private $characterFilters;

    /**
     * @var Collection
     */
    private $tokenFilters;

    /**
     * @var int
     */
    private $positionIncrementGap = 100;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->characterFilters = collect();
        $this->tokenFilters = collect();
    }

    /**
     * @param string $tokenizer
     * @return self
     */
    public function setTokenizer(string $tokenizer): self
    {
        $this->tokenizer = $tokenizer;
        return $this;
    }

    /**
     * @param string $characterFilter
     * @return self
     */
    public function addCharacterFilter(string $characterFilter): self
    {
        $this->characterFilters->push($characterFilter);
        return $this;
    }

    /**
     * @param string $tokenFilter
     * @return self
     */
    public function addTokenFilter(string $tokenFilter): self
    {
        $this->tokenFilters->push($tokenFilter);
        return $this;
    }

    /**
     * @param int $positionIncrementGap
     * @return self
     */
    public function setPositionIncrementGap(int $positionIncrementGap): self
    {
        $this->positionIncrementGap = $positionIncrementGap;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $analyzer = [
            'type' => Analyzer::TYPE_CUSTOM,
            'position_increment_gap' => $this->positionIncrementGap,
            'tokenizer' => $this->tokenizer
        ];

        if ($this->characterFilters->count() > 0) {
            $analyzer['char_filter'] = $this->characterFilters->values()->all();
        }

        if ($this->tokenFilters->count() > 0) {
            $analyzer['filter'] = $this->tokenFilters->values()->all();
        }

        return $analyzer;
    }
}
