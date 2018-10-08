<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Nameable;

interface Analyzer extends Arrayable, Nameable
{
    const TYPE_STANDARD = 'standard';
    const TYPE_SIMPLE = 'simple';
    const TYPE_WHITESPACE = 'whitespace';
    const TYPE_STOP = 'stop';
}
