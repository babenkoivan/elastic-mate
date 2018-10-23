<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\CanIgnoreCase;
use Illuminate\Support\Collection;

final class KeywordMakerTokenFilter extends AbstractTokenFilter
{
    use CanIgnoreCase;

    /**
     * @var Collection
     */
    private $keywords;

    /**
     * @var string
     */
    private $keywordsPath;

    /**
     * @var string
     */
    private $keywordsPattern;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->keywords = collect();
    }

    /**
     * @param string $keyword
     * @return self
     */
    public function addKeyword(string $keyword): self
    {
        $this->keywords->push($keyword);
        return $this;
    }

    /**
     * @param string $keywordsPath
     * @return self
     */
    public function setKeywordsPath(string $keywordsPath): self
    {
        $this->keywordsPath = $keywordsPath;
        return $this;
    }

    /**
     * @param string $keywordsPattern
     * @return self
     */
    public function setKeywordsPattern(string $keywordsPattern): self
    {
        $this->keywordsPattern = $keywordsPattern;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenFilter = [
            'type' => TokenFilter::TYPE_KEYWORD_MAKER,
            'ignore_case' => $this->ignoreCase
        ];

        if (isset($this->keywordsPath)) {
            $tokenFilter['keywords_path'] = $this->keywordsPath;
        } elseif (isset($this->keywordsPattern)) {
            $tokenFilter['keywords_pattern'] = $this->keywordsPattern;
        } else {
            $tokenFilter['keywords'] = $this->keywords->values()->all();
        }

        return $tokenFilter;
    }
}
