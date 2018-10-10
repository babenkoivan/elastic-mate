<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStemExclusion;

final class ItalianAnalyzer extends AbstractLanguageAnalyzer
{
    use HasStemExclusion;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->type = Analyzer::TYPE_ITALIAN;
        $this->stopWords = Analysis::STOP_WORDS_ITALIAN;
    }
}
