<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Nameable;

interface TokenFilter extends Nameable, Arrayable
{
    const TYPE_STANDARD = 'standard';
    const TYPE_ASCII_FOLDING = 'asciifolding';
    const TYPE_FLATTEN_GRAPH = 'flatten_graph';
    const TYPE_LENGTH = 'length';
}
