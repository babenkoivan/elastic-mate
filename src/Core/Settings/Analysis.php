<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use Illuminate\Support\Collection;

class Analysis implements Arrayable
{
    const STOP_WORDS_ARABIC = '_arabic_';
    const STOP_WORDS_ARMENIAN = '_armenian_';
    const STOP_WORDS_BASQUE = '_basque_';
    const STOP_WORDS_BENGALI = '_bengali_';
    const STOP_WORDS_BRAZILIAN = '_brazilian_';
    const STOP_WORDS_BULGARIAN = '_bulgarian_';
    const STOP_WORDS_CATALAN = '_catalan_';
    const STOP_WORDS_CZECH = '_czech_';
    const STOP_WORDS_DANISH = '_danish_';
    const STOP_WORDS_DUTCH = '_dutch_';
    const STOP_WORDS_ENGLISH = '_english_';
    const STOP_WORDS_FINNISH = '_finnish_';
    const STOP_WORDS_FRENCH = '_french_';
    const STOP_WORDS_GALICIAN = '_galician_';
    const STOP_WORDS_GERMAN = '_german_';
    const STOP_WORDS_GREEK = '_greek_';
    const STOP_WORDS_HINDI = '_hindi_';
    const STOP_WORDS_HUNGARIAN = '_hungarian_';
    const STOP_WORDS_INDONESIAN = '_indonesian_';
    const STOP_WORDS_IRISH = '_irish_';
    const STOP_WORDS_ITALIAN = '_italian_';
    const STOP_WORDS_LATVIAN = '_latvian_';
    const STOP_WORDS_NORWEGIAN = '_norwegian_';
    const STOP_WORDS_PERSIAN = '_persian_';
    const STOP_WORDS_PORTUGUESE = '_portuguese_';
    const STOP_WORDS_ROMANIAN = '_romanian_';
    const STOP_WORDS_RUSSIAN = '_russian_';
    const STOP_WORDS_SORANI = '_sorani_';
    const STOP_WORDS_SPANISH = '_spanish_';
    const STOP_WORDS_SWEDISH = '_swedish_';
    const STOP_WORDS_THAI = '_thai_';
    const STOP_WORDS_TURKISH = '_turkish_';
    const STOP_WORDS_NONE = '\_none_';

    const REGEXP_FLAG_CANON_EQ = 'CANON_EQ';
    const REGEXP_FLAG_CASE_INSENSITIVE = 'CASE_INSENSITIVE';
    const REGEXP_FLAG_COMMENTS = 'COMMENTS';
    const REGEXP_FLAG_DOTALL = 'DOTALL';
    const REGEXP_FLAG_LITERAL = 'LITERAL';
    const REGEXP_FLAG_MULTILINE = 'MULTILINE';
    const REGEXP_FLAG_UNICODE_CASE = 'UNICODE_CASE';
    const REGEXP_FLAG_UNICODE_CHARACTER_CLASS = 'UNICODE_CHARACTER_CLASS';
    const REGEXP_FLAG_UNIX_LINES = 'UNIX_LINES';

    const CHAR_GROUP_LETTER = 'letter';
    const CHAR_GROUP_DIGIT = 'digit';
    const CHAR_GROUP_WHITESPACE = 'whitespace';
    const CHAR_GROUP_PUNCTUATION = 'punctuation';
    const CHAR_GROUP_SYMBOL = 'symbol';

    /**
     * @var Collection
     */
    private $analyzers;

    public function __construct()
    {
        $this->analyzers = collect();
    }

    /**
     * @param Analyzer $analyzer
     * @return self
     */
    public function addAnalyzer(Analyzer $analyzer): self
    {
        $this->analyzers->push($analyzer);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $analysis = [];

        $analyzers = $this->analyzers->mapWithKeys(function (Analyzer $analyzer) {
            return [
                $analyzer->getName() => $analyzer->toArray()
            ];
        });

        if ($analyzers->count() > 0) {
            $analysis['analyzer'] = $analyzers->all();
        }

        return $analysis;
    }
}
