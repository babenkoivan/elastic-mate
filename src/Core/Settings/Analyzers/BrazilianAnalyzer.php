<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

final class BrazilianAnalyzer extends AbstractLanguageAnalyzer
{
    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->type = Analyzer::TYPE_BRAZILIAN;
        $this->setStopWords(Analysis::STOP_WORDS_BRAZILIAN);
    }
}
