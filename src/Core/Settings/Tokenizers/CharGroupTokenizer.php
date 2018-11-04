<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use Illuminate\Support\Collection;

final class CharGroupTokenizer extends AbstractTokenizer
{
    /**
     * @var Collection
     */
    private $tokenizeOnChars;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->tokenizeOnChars = collect();
    }

    /**
     * @param string $char
     * @return self
     */
    public function addChar(string $char): self
    {
        $this->tokenizeOnChars->push($char);
        return $this;
    }
    
    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenizer = [
            'type' => Tokenizer::TYPE_CHAR_GROUP
        ];

        if ($this->tokenizeOnChars->count() > 0) {
            $tokenizer['tokenize_on_chars'] = $this->tokenizeOnChars->values()->all();
        }

        return $tokenizer;
    }
}
