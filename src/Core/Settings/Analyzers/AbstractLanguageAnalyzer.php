<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWords;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWordsPath;

abstract class AbstractLanguageAnalyzer extends AbstractAnalyzer
{
    use HasStopWords, HasStopWordsPath;

    /**
     * @var string
     */
    protected $type;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $analyzer = [
            'type' => $this->type,
            'stopwords' => $this->stopWords
        ];

        if (isset($this->stopWordsPath)) {
            $analyzer['stopwords_path'] = $this->stopWordsPath;
        }

        if (isset($this->stemExclusion)) {
            $analyzer['stem_exclusion'] = $this->stemExclusion->values()->all();
        }

        return $analyzer;
    }
}
