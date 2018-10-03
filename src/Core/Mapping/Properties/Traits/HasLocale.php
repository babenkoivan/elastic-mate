<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;

trait HasLocale
{
    /**
     * @var string
     */
    private $locale = Property::LOCALE_ROOT;

    /**
     * @param string $locale
     * @return self
     */
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }
}
