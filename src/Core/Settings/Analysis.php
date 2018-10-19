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

    const LANGUAGE_ARABIC = 'arabic';
    const LANGUAGE_ARMENIAN = 'armenian';
    const LANGUAGE_BASQUE = 'basque';
    const LANGUAGE_BENGALI = 'bengali';
    const LANGUAGE_LIGHT_BENGALI = 'light_bengali';
    const LANGUAGE_BRAZILIAN = 'brazilian';
    const LANGUAGE_BULGARIAN = 'bulgarian';
    const LANGUAGE_CATALAN = 'catalan';
    const LANGUAGE_CZECH = 'czech';
    const LANGUAGE_DANISH = 'danish';
    const LANGUAGE_DUTCH = 'dutch';
    const LANGUAGE_DUTCH_KP = 'dutch_kp';
    const LANGUAGE_ENGLISH = 'english';
    const LANGUAGE_LIGHT_ENGLISH = 'light_english';
    const LANGUAGE_MINIMAL_ENGLISH = 'minimal_english';
    const LANGUAGE_POSSESSIVE_ENGLISH = 'possessive_english';
    const LANGUAGE_PORTER2 = 'porter2';
    const LANGUAGE_LOVINS = 'lovins';
    const LANGUAGE_FINNISH = 'finnish';
    const LANGUAGE_LIGHT_FINNISH = 'light_finnish';
    const LANGUAGE_FRENCH = 'french';
    const LANGUAGE_LIGHT_FRENCH = 'light_french';
    const LANGUAGE_MINIMAL_FRENCH = 'minimal_french';
    const LANGUAGE_GALICIAN = 'galician';
    const LANGUAGE_MINIMAL_GALICIAN = 'minimal_galician';
    const LANGUAGE_GERMAN = 'german';
    const LANGUAGE_GERMAN2 = 'german2';
    const LANGUAGE_LIGHT_GERMAN2 = 'light_german';
    const LANGUAGE_MINIMAL_GERMAN2 = 'minimal_german';
    const LANGUAGE_GREEK = 'greek';
    const LANGUAGE_HINDI = 'hindi';
    const LANGUAGE_HUNGARIAN = 'hungarian';
    const LANGUAGE_LIGHT_HUNGARIAN = 'light_hungarian';
    const LANGUAGE_INDONESIAN = 'indonesian';
    const LANGUAGE_IRISH = 'irish';
    const LANGUAGE_ITALIAN = 'italian';
    const LANGUAGE_LIGHT_ITALIAN = 'light_italian';
    const LANGUAGE_SORANI = 'sorani';
    const LANGUAGE_LATVIAN = 'latvian';
    const LANGUAGE_LITHUANIAN = 'lithuanian';
    const LANGUAGE_NORWEGIAN = 'norwegian';
    const LANGUAGE_LIGHT_NORWEGIAN = 'light_norwegian';
    const LANGUAGE_MINIMAL_NORWEGIAN = 'minimal_norwegian';
    const LANGUAGE_LIGHT_NYNORSK = 'light_nynorsk';
    const LANGUAGE_MINIMAL_NYNORSK = 'minimal_nynorsk';
    const LANGUAGE_PORTUGUESE = 'portuguese';
    const LANGUAGE_LIGHT_PORTUGUESE = 'light_portuguese';
    const LANGUAGE_MINIMAL_PORTUGUESE = 'minimal_portuguese';
    const LANGUAGE_PORTUGUESE_RSLP = 'portuguese_rslp';
    const LANGUAGE_ROMANIAN = 'romanian';
    const LANGUAGE_RUSSIAN = 'russian';
    const LANGUAGE_LIGHT_RUSSIAN = 'light_russian';
    const LANGUAGE_SPANISH = 'spanish';
    const LANGUAGE_LIGHT_SPANISH = 'light_spanish';
    const LANGUAGE_SWEDISH = 'swedish';
    const LANGUAGE_LIGHT_SWEDISH = 'light_swedish';
    const LANGUAGE_TURKISH = 'turkish';

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
