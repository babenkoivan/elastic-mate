<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Settings\Traits\CanPreserveOriginal;
use Illuminate\Support\Collection;

abstract class AbstractWordDelimiterTokenFilter extends AbstractTokenFilter
{
    use CanPreserveOriginal;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var bool
     */
    private $generateWordParts = true;

    /**
     * @var bool
     */
    private $generateNumberParts = true;

    /**
     * @var bool
     */
    private $catenateWords = false;

    /**
     * @var bool
     */
    private $catenateNumbers = false;

    /**
     * @var bool
     */
    private $catenateAll = false;

    /**
     * @var bool
     */
    private $splitOnCaseChange = true;

    /**
     * @var bool
     */
    private $splitOnNumerics = true;

    /**
     * @var bool
     */
    private $stemEnglishPossessive = true;

    /**
     * @var Collection
     */
    private $protectedWords;

    /**
     * @var string
     */
    private $protectedWordsPath;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->protectedWords = collect();
    }

    /**
     * @param bool $generateWordParts
     * @return self
     */
    public function setGenerateWordParts(bool $generateWordParts): self
    {
        $this->generateWordParts = $generateWordParts;
        return $this;
    }

    /**
     * @param bool $generateNumberParts
     * @return self
     */
    public function setGenerateNumberParts(bool $generateNumberParts): self
    {
        $this->generateNumberParts = $generateNumberParts;
        return $this;
    }

    /**
     * @param bool $catenateWords
     * @return self
     */
    public function setCatenateWords(bool $catenateWords): self
    {
        $this->catenateWords = $catenateWords;
        return $this;
    }

    /**
     * @param bool $catenateNumbers
     * @return self
     */
    public function setCatenateNumbers(bool $catenateNumbers): self
    {
        $this->catenateNumbers = $catenateNumbers;
        return $this;
    }

    /**
     * @param bool $catenateAll
     * @return self
     */
    public function setCatenateAll(bool $catenateAll): self
    {
        $this->catenateAll = $catenateAll;
        return $this;
    }

    /**
     * @param bool $splitOnCaseChange
     * @return self
     */
    public function setSplitOnCaseChange(bool $splitOnCaseChange): self
    {
        $this->splitOnCaseChange = $splitOnCaseChange;
        return $this;
    }

    /**
     * @param bool $splitOnNumerics
     * @return self
     */
    public function setSplitOnNumerics(bool $splitOnNumerics): self
    {
        $this->splitOnNumerics = $splitOnNumerics;
        return $this;
    }

    /**
     * @param bool $stemEnglishPossessive
     * @return self
     */
    public function setStemEnglishPossessive(bool $stemEnglishPossessive): self
    {
        $this->stemEnglishPossessive = $stemEnglishPossessive;
        return $this;
    }

    /**
     * @param string $protectedWord
     * @return self
     */
    public function protectWord(string $protectedWord): self
    {
        $this->protectedWords->push($protectedWord);
        return $this;
    }

    /**
     * @param string $protectedWordsPath
     * @return self
     */
    public function setProtectedWordsPath(string $protectedWordsPath): self
    {
        $this->protectedWordsPath = $protectedWordsPath;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenFilter = [
            'type' => $this->type,
            'generate_word_parts' => $this->generateWordParts,
            'generate_number_parts' => $this->generateNumberParts,
            'catenate_words' => $this->catenateWords,
            'catenate_numbers' => $this->catenateNumbers,
            'catenate_all' => $this->catenateAll,
            'split_on_case_change' => $this->splitOnCaseChange,
            'preserve_original' => $this->preserveOriginal,
            'split_on_numerics' => $this->splitOnNumerics,
            'stem_english_possessive' => $this->stemEnglishPossessive
        ];

        if (isset($this->protectedWordsPath)) {
            $tokenFilter['protected_words_path'] = $this->protectedWordsPath;
        } elseif ($this->protectedWords->count() > 0) {
            $tokenFilter['protected_words'] = $this->protectedWords->values()->all();
        }

        return $tokenFilter;
    }
}
