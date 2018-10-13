<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Nameable;

interface Tokenizer extends Arrayable, Nameable
{
    const TYPE_STANDARD = 'standard';
    const TYPE_LETTER = 'letter';
    const TYPE_LOWERCASE = 'lowercase';
    const TYPE_WHITESPACE = 'whitespace';
}
