<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use Illuminate\Support\Collection;

final class KeepWordsTokenFilter extends AbstractTokenFilter
{
    /**
     * @var Collection
     */
    private $keepWords;

    /**
     * @var string
     */
    private $keepWordsPath;

    /**
     * @var bool
     */
    private $keepWordsCase = false;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->keepWords = collect();
    }

    /**
     * @param string $keepWord
     * @return self
     */
    public function addKeepWord(string $keepWord): self
    {
        $this->keepWords->push($keepWord);
        return $this;
    }

    /**
     * @param string $keepWordsPath
     * @return self
     */
    public function setKeepWordsPath(string $keepWordsPath): self
    {
        $this->keepWordsPath = $keepWordsPath;
        return $this;
    }

    /**
     * @param bool $keepWordsCase
     * @return self
     */
    public function setKeepWordsCase(bool $keepWordsCase): self
    {
        $this->keepWordsCase = $keepWordsCase;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenFilter = [
            'type' => TokenFilter::TYPE_KEEP_WORDS,
            'keep_words_case' => $this->keepWordsCase
        ];

        if (isset($this->keepWordsPath)) {
            $tokenFilter['keep_words_path'] = $this->keepWordsPath;
        } else {
            $tokenFilter['keep_words'] = $this->keepWords->values()->all();
        }

        return $tokenFilter;
    }
}
