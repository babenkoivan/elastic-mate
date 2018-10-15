<?php
declare(strict_types = 1);

namespace BabenkoIvan\ElasticMate\Core\Entities;

use BabenkoIvan\ElasticMate\Core\Contracts\Nameable;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Settings\Settings;
use BabenkoIvan\ElasticMate\Core\Traits\HasName;

final class Index implements Nameable
{
    use HasName;

    /**
     * @var Mapping
     */
    private $mapping;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * @param string $name
     */
    public function __construct(string $name) {
        $this->name = $name;
        $this->mapping = new Mapping();
        $this->settings = new Settings();
    }

    /**
     * @return Mapping
     */
    public function getMapping(): Mapping
    {
        return $this->mapping;
    }

    /**
     * @param Mapping $mapping
     * @return self
     */
    public function setMapping(Mapping $mapping): self
    {
        $this->mapping = $mapping;
        return $this;
    }

    /**
     * @return Settings
     */
    public function getSettings(): Settings
    {
        return $this->settings;
    }

    /**
     * @param Settings $settings
     * @return self
     */
    public function setSettings(Settings $settings): self
    {
        $this->settings = $settings;
        return $this;
    }
}
