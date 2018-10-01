<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use Illuminate\Support\Collection;

class Analysis implements Arrayable
{
    /**
     * @var Collection
     */
    private $analyzers;

    public function __construct()
    {
        $this->analyzers = collect();
    }

    /**
     * @param Analyzer $analyzer
     * @return self
     */
    public function addAnalyzer(Analyzer $analyzer): self
    {
        $this->analyzers->push($analyzer);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $analysis = [];

        $analyzers = $this->analyzers->mapWithKeys(function (Analyzer $analyzer) {
            return [
                $analyzer->getName() => $analyzer->toArray()
            ];
        });

        if ($analyzers->count() > 0) {
            $analysis['analyzer'] = $analyzers->all();
        }

        return $analysis;
    }
}
