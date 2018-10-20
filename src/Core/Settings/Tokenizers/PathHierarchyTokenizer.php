<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasBufferSize;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasDelimiter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasReplacement;

final class PathHierarchyTokenizer extends AbstractTokenizer
{
    use HasDelimiter, HasReplacement, HasBufferSize;

    /**
     * @var bool
     */
    private $isReversed = false;

    /**
     * @var int
     */
    private $skip = 0;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->setBufferSize(1024);
    }

    /**
     * @param bool $isReversed
     * @return self
     */
    public function setReversed(bool $isReversed): self
    {
        $this->isReversed = $isReversed;
        return $this;
    }

    /**
     * @param int $skip
     * @return self
     */
    public function setSkip(int $skip): self
    {
        $this->skip = $skip;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenizer = [
            'type' => Tokenizer::TYPE_PATH_HIERARCHY,
            'delimiter' => $this->delimiter,
            'buffer_size' => $this->bufferSize,
            'reverse' => $this->isReversed,
            'skip' => $this->skip
        ];

        if (isset($this->replacement)) {
            $tokenizer['replacement'] = $this->replacement;
        }

        return $tokenizer;
    }
}
