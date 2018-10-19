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
    const TYPE_LOWER_CASE = 'lowercase';
    const TYPE_UPPER_CASE = 'uppercase';
    const TYPE_NGRAM = 'nGram';
    const TYPE_EDGE_NGRAM = 'edgeNGram';
    const TYPE_PORTER_STEM = 'porter_stem';
    const TYPE_SHINGLE = 'shingle';
    const TYPE_STOP = 'stop';
    const TYPE_WORD_DELIMITER = 'word_delimiter';
    const TYPE_WORD_DELIMITER_GRAPH = 'word_delimiter_graph';
    const TYPE_MULTIPLEXER = 'multiplexer';
    const TYPE_STEMMER = 'stemmer';
    const TYPE_STEMMER_OVERRIDE = 'stemmer_override';
    const TYPE_KEYWORD_MAKER = 'keyword_marker';
    const TYPE_KEYWORD_REPEAT = 'keyword_repeat';
}
