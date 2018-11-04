<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanEagerGlobalOrdinals;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeIndexed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeStored;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasAnalyzer;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanUseFieldData;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasIndexOptions;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanUseNorms;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasSearchQuoteAnalyzer;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasSearchAnalyzer;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasSimilarity;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasTermVector;

final class TextProperty extends AbstractProperty
{
    use HasAnalyzer,
        HasBoost,
        CanEagerGlobalOrdinals,
        CanUseFieldData,
        CanBeIndexed,
        HasIndexOptions,
        CanUseNorms,
        CanBeStored,
        HasSearchAnalyzer,
        HasSearchQuoteAnalyzer,
        HasSimilarity,
        HasTermVector;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $property = [
            'type' => 'text',
            'boost' => $this->boost,
            'eager_global_ordinals' => $this->eagerGlobalOrdinals,
            'fielddata' => $this->fieldData,
            'index' => $this->index,
            'index_options' => $this->indexOptions,
            'norms' => $this->norms,
            'store' => $this->store,
            'similarity' => $this->similarity,
            'term_vector' => $this->termVector
        ];

        if (isset($this->analyzer)) {
            $property['analyzer'] = $this->analyzer;
        }

        if (isset($this->searchAnalyzer)) {
            $property['search_analyzer'] = $this->searchAnalyzer;
        }

        if (isset($this->searchQuoteAnalyzer)) {
            $property['search_quote_analyzer'] = $this->searchQuoteAnalyzer;
        }

        return $property;
    }
}
