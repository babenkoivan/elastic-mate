<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Support;

use BabenkoIvan\ElasticMate\Core\Contracts\Stringable;

final class StemmingRule implements Stringable
{
    /**
     * @var string
     */
    private $word;

    /**
     * @var string
     */
    private $stem;

    /**
     * @param string $word
     * @param string $stem
     */
    public function __construct(string $word, string $stem)
    {
        $this->word = $word;
        $this->stem = $stem;
    }

    /**
     * @inheritdoc
     */
    public function toString(): string
    {
        return sprintf(
            '%s => %s',
            $this->word,
            $this->stem
        );
    }
}
