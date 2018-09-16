<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;

class Settings implements Arrayable
{
    /**
     * @var Analysis|null
     */
    private $analysis;

    /**
     * @param Analysis|null $analysis
     */
    public function __construct(
        ?Analysis $analysis = null
    ) {
        $this->analysis = $analysis;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $settings = [];

        $analysis = $this->analysis ? $this->analysis->toArray() : [];

        if (!empty($analysis)) {
            $settings['analysis'] = $analysis;
        }

        return $settings;
    }
}
