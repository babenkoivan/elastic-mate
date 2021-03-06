<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Nameable;

interface CharacterFilter extends Nameable, Arrayable
{
    const TYPE_HTML_STRIP = 'html_strip';
    const TYPE_MAPPING = 'mapping';
    const TYPE_PATTERN_REPLACE = 'pattern_replace';
}
