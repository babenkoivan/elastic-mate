<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasFlags;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasPattern;

final class PatternTokenizer extends AbstractTokenizer
{
    use HasPattern, HasFlags;

    /**
     * @var int
     */
    private $group = -1;

    /**
     * @param int $group
     * @return self
     */
    public function setGroup(int $group): self
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenizer = [
            'type' => Tokenizer::TYPE_PATTERN,
            'pattern' => $this->pattern,
            'group' => $this->group
        ];

        if (isset($this->flags)) {
            $tokenizer['flags'] = $this->flags->implode('|');
        }

        return $tokenizer;
    }
}
