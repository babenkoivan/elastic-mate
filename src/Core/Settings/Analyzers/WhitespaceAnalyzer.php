<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

class WhitespaceAnalyzer extends AbstractAnalyzer
{
    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'whitespace'
        ];
    }
}
