<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanEagerGlobalOrdinals;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeIndexed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeStored;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasIndexOptions;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanUseNorms;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasSimilarity;

final class TextProperty extends AbstractProperty
{
    use HasBoost,
        CanEagerGlobalOrdinals,
        CanBeIndexed,
        HasIndexOptions,
        CanUseNorms,
        CanBeStored,
        HasSimilarity;

    /**
     * @var bool
     */
    private $fieldData = false;

    /**
     * @var string
     */
    private $termVector = Mapping::TERM_VECTOR_NO;

    /**
     * @var string|null
     */
    private $analyzer;

    /**
     * @var string|null
     */
    private $searchAnalyzer;

    /**
     * @var string|null
     */
    private $searchQuoteAnalyzer;

    /**
     * @param bool $fieldData
     * @return self
     */
    public function setFieldData(bool $fieldData): self
    {
        $this->fieldData = $fieldData;
        return $this;
    }

    /**
     * @param string $termVector
     * @return self
     */
    public function setTermVector(string $termVector): self
    {
        $this->termVector = $termVector;
        return $this;
    }

    /**
     * @param string $analyzer
     * @return self
     */
    public function setAnalyzer(string $analyzer): self
    {
        $this->analyzer = $analyzer;
        return $this;
    }

    /**
     * @param string $searchAnalyzer
     * @return self
     */
    public function setSearchAnalyzer(string $searchAnalyzer): self
    {
        $this->searchAnalyzer = $searchAnalyzer;
        return $this;
    }

    /**
     * @param string $searchQuoteAnalyzer
     * @return self
     */
    public function setSearchQuoteAnalyzer(string $searchQuoteAnalyzer): self
    {
        $this->searchQuoteAnalyzer = $searchQuoteAnalyzer;
        return $this;
    }

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
