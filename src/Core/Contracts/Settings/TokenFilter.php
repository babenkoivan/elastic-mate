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
    const TYPE_KSTEM = 'kstem';
    const TYPE_SNOWBALL = 'snowball';
    const TYPE_SYNONYM = 'synonym';
    const TYPE_HYPHENATION_DECOMPOUNDER = 'hyphenation_decompounder';
    const TYPE_DICTIONARY_DECOMPOUNDER = 'dictionary_decompounder';
    const TYPE_REVERSE = 'reverse';
    const TYPE_ELISION = 'elision';
    const TYPE_TRUNCATE = 'truncate';
    const TYPE_UNIQUE = 'unique';
    const TYPE_PATTERN_CAPTURE = 'pattern_capture';
    const TYPE_PATTERN_REPLACE = 'pattern_replace';
    const TYPE_LIMIT = 'limit';
    const TYPE_HUNSPELL = 'hunspell';
    const TYPE_COMMON_GRAMS = 'common_grams';
    const TYPE_ARABIC_NORMALIZATION = 'arabic_normalization';
    const TYPE_GERMAN_NORMALIZATION = 'german_normalization';
    const TYPE_HINDI_NORMALIZATION = 'hindi_normalization';
    const TYPE_INDIC_NORMALIZATION = 'indic_normalization';
    const TYPE_SORANI_NORMALIZATION = 'sorani_normalization';
    const TYPE_PERSIAN_NORMALIZATION = 'persian_normalization';
    const TYPE_SCANDINAVIAN_NORMALIZATION = 'scandinavian_normalization';
    const TYPE_SCANDINAVIAN_FOLDING = 'scandinavian_folding';
    const TYPE_SERBIAN_FOLDING = 'serbian_normalization';
    const TYPE_CJK_WIDTH = 'cjk_width';
    const TYPE_CJK_BIGRAM = 'cjk_bigram';
    const TYPE_KEEP = 'keep';
    const TYPE_KEEP_TYPES = 'keep_types';
    const TYPE_CLASSIC = 'classic';
    const TYPE_APOSTROPHE = 'apostrophe';
    const TYPE_DECIMAL_DIGIT = 'decimal_digit';
    const TYPE_FINGERPRINT = 'fingerprint';
    const TYPE_MIN_HASH = 'min_hash';
    const TYPE_REMOVE_DUPLICATES = 'remove_duplicates';
}
