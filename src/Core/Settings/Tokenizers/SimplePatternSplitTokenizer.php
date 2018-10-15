<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasPattern;

final class SimplePatternSplitTokenizer extends AbstractTokenizer
{
    use HasPattern;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->pattern = '';
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => Tokenizer::TYPE_SIMPLE_PATTERN_SPLIT,
            'pattern' => $this->pattern
        ];
    }
}
