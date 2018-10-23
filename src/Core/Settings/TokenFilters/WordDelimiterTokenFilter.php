<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;

final class WordDelimiterTokenFilter extends AbstractWordDelimiterTokenFilter
{
    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->type = TokenFilter::TYPE_WORD_DELIMITER;
    }
}
