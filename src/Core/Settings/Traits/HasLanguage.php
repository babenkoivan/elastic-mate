<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

trait HasLanguage
{
    /**
     * @var string
     */
    private $language = Analysis::LANGUAGE_ENGLISH;

    /**
     * @param string $language
     * @return self
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }
}
