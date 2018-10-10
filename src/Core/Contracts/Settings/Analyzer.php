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
    const TYPE_KEYWORD = 'keyword';
    const TYPE_PATTERN = 'pattern';
    const TYPE_ARABIC = 'arabic';
    const TYPE_ARMENIAN = 'armenian';
    const TYPE_BASQUE = 'basque';
    const TYPE_BENGALI = 'bengali';
    const TYPE_BRAZILIAN = 'brazilian';
    const TYPE_BULGARIAN = 'bulgarian';
    const TYPE_CATALAN = 'catalan';
    const TYPE_CJK = 'cjk';
    const TYPE_CZECH = 'czech';
    const TYPE_DANISH = 'danish';
    const TYPE_DUTCH = 'dutch';
    const TYPE_ENGLISH = 'english';
    const TYPE_FINNISH = 'finnish';
    const TYPE_FRENCH = 'french';
    const TYPE_GALICIAN = 'galician';
    const TYPE_GERMAN = 'german';
    const TYPE_GREEK = 'greek';
    const TYPE_HINDI = 'hindi';
    const TYPE_HUNGARIAN = 'hungarian';
    const TYPE_INDONESIAN = 'indonesian';
    const TYPE_IRISH = 'irish';
    const TYPE_ITALIAN = 'italian';
    const TYPE_LITHUANIAN = 'lithuanian';
    const TYPE_NORWEGIAN = 'norwegian';
    const TYPE_PERSIAN = 'persian';
    const TYPE_PORTUGUESE = 'portuguese';
    const TYPE_RUSSIAN = 'russian';
    const TYPE_SORANI = 'sorani';
    const TYPE_SPANISH = 'spanish';
    const TYPE_SWEDISH = 'swedish';
    const TYPE_TURKISH = 'turkish';
    const TYPE_THAI = 'thai';
}
