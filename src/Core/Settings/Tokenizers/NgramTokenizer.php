<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use Illuminate\Support\Collection;

class NgramTokenizer extends AbstractTokenizer
{
    const CHAR_CLASS_LETTER = 'letter';
    const CHAR_CLASS_DIGIT = 'digit';
    const CHAR_CLASS_WHITESPACE = 'whitespace';
    const CHAR_CLASS_PUNCTUATION = 'punctuation';
    const CHAR_CLASS_SYMBOL = 'symbol';

    /**
     * @var int
     */
    private $minGram = 1;

    /**
     * @var int
     */
    private $maxGram = 2;

    /**
     * @var Collection
     */
    private $tokenChars;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->tokenChars = collect();
    }

    /**
     * @param int $minGram
     * @return self
     */
    public function setMinGram(int $minGram): self
    {
        $this->minGram = $minGram;
        return $this;
    }

    /**
     * @param int $maxGram
     * @return self
     */
    public function setMaxGram(int $maxGram): self
    {
        $this->maxGram = $maxGram;
        return $this;
    }

    /**
     * @param string $charClass
     * @return self
     */
    public function addTokenChars(string $charClass): self
    {
        $this->tokenChars->push($charClass);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenizer = [
            'type' => Tokenizer::TYPE_NGRAM,
            'min_gram' => $this->minGram,
            'max_gram' => $this->maxGram
        ];

        if ($this->tokenChars->count() > 0) {
            $tokenizer['token_chars'] = $this->tokenChars->values()->all();
        }

        return $tokenizer;
    }
}
