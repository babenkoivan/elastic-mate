<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMaxOutputSize;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasSeparator;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWords;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWordsPath;

final class FingerprintAnalyzer extends AbstractAnalyzer
{
    use HasSeparator,
        HasMaxOutputSize,
        HasStopWords,
        HasStopWordsPath;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $analyzer = [
            'type' => Analyzer::TYPE_FINGERPRINT,
            'separator' => $this->separator,
            'max_output_size' => $this->maxOutputSize,
            'stopwords' => $this->stopWords
        ];

        if (isset($this->stopWordsPath)) {
            $analyzer['stopwords_path'] = $this->stopWordsPath;
        }

        return $analyzer;
    }
}
