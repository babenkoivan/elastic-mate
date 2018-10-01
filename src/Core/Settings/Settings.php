<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use InvalidArgumentException;

class Settings implements Arrayable
{
    const IMMUTABLE_OPTIONS = [
        'number_of_shards'
    ];

    /**
     * @var int
     */
    private $numberOfShards = 5;

    /**
     * @var Analysis|null
     */
    private $analysis;

    /**
     * @param int $numberOfShards
     * @return self
     */
    public function setNumberOfShards(int $numberOfShards): self
    {
        $this->numberOfShards = $numberOfShards;
        return $this;
    }

    /**
     * @param Analysis $analysis
     * @return Settings
     */
    public function setAnalysis(Analysis $analysis): self
    {
        $this->analysis = $analysis;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $settings = [
            'number_of_shards' => $this->numberOfShards
        ];

        $analysis = isset($this->analysis) ? $this->analysis->toArray() : null;

        if (!empty($this->analysis)) {
            $settings['analysis'] = $analysis;
        }

        return $settings;
    }
}
