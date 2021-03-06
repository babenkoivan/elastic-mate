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
    const TYPE_UAX_URL_EMAIL = 'uax_url_email';
    const TYPE_CLASSIC = 'classic';
    const TYPE_THAI = 'thai';
    const TYPE_NGRAM = 'ngram';
    const TYPE_EDGE_NGRAM = 'edge_ngram';
    const TYPE_KEYWORD = 'keyword';
    const TYPE_PATTERN = 'pattern';
    const TYPE_SIMPLE_PATTERN = 'simple_pattern';
    const TYPE_SIMPLE_PATTERN_SPLIT = 'simple_pattern_split';
    const TYPE_CHAR_GROUP = 'char_group';
    const TYPE_PATH_HIERARCHY = 'path_hierarchy';
}
