<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMaxGram;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMinGram;
use Illuminate\Support\Collection;

abstract class AbstractNgramTokenizer extends AbstractTokenizer
{
    use HasMinGram, HasMaxGram;

    /**
     * @var string
     */
    protected $type;

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
     * @param string $charGroup
     * @return self
     */
    public function addTokenChars(string $charGroup): self
    {
        $this->tokenChars->push($charGroup);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenizer = [
            'type' => $this->type,
            'min_gram' => $this->minGram,
            'max_gram' => $this->maxGram
        ];

        if ($this->tokenChars->count() > 0) {
            $tokenizer['token_chars'] = $this->tokenChars->values()->all();
        }

        return $tokenizer;
    }
}
