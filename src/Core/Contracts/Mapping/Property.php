<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Mapping;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Nameable;

interface Property extends Nameable, Arrayable
{
    const INDEX_OPTIONS_DOCS = 'docs';
    const INDEX_OPTIONS_FREQS = 'freqs';
    const INDEX_OPTIONS_POSITIONS = 'positions';
    const INDEX_OPTIONS_OFFSETS = 'offsets';

    const SIMILARITY_BM25 = 'BM25';
    const SIMILARITY_CLASSIC = 'classic';
    const SIMILARITY_BOOLEAN = 'boolean';
}
