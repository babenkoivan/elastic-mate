<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use InvalidArgumentException;

class Settings implements Arrayable
{
    /**
     * @var Analysis|null
     */
    private $analysis;

    /**
     * @param Analysis $analysis
     */
    public function __construct(
        Analysis $analysis = null
    ) {
        // todo check for another settings
        if (!isset($analysis)) {
            throw new InvalidArgumentException(
                'At least one of the configurations must be used: analysis'
            );
        }

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
