<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\CanIgnoreCase;
use Illuminate\Support\Collection;

final class CommonGramsTokenFilter extends AbstractTokenFilter
{
    use CanIgnoreCase;

    /**
     * @var Collection
     */
    private $commonWords;

    /**
     * @var string
     */
    private $commonWordsPath;

    /**
     * @var bool
     */
    private $queryMode = false;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->commonWords = collect();
    }

    /**
     * @param string $commonWord
     * @return CommonGramsTokenFilter
     */
    public function addCommonWord(string $commonWord): self
    {
        $this->commonWords->push($commonWord);
        return $this;
    }

    /**
     * @param string $commonWordsPath
     * @return self
     */
    public function setCommonWordsPath(string $commonWordsPath): self
    {
        $this->commonWordsPath = $commonWordsPath;
        return $this;
    }

    /**
     * @param bool $queryMode
     * @return self
     */
    public function setQueryMode(bool $queryMode): self
    {
        $this->queryMode = $queryMode;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenFilter = [
            'type' => TokenFilter::TYPE_COMMON_GRAMS,
            'ignore_case' => $this->ignoreCase,
            'query_mode' => $this->queryMode
        ];

        if (isset($this->commonWordsPath)) {
            $tokenFilter['common_words_path'] = $this->commonWordsPath;
        } else {
            $tokenFilter['common_words'] = $this->commonWords->values()->all();
        }

        return $tokenFilter;
    }
}
