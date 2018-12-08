# Analysis

Learn more about analysis in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\ClassicTokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\HtmlStripCharacterFilter;
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\LengthTokenFilter;

$analysis = (new Analysis())
    ->addAnalyzer(new StandardAnalyzer('my_analyzer'))
    ->addTokenizer(new ClassicTokenizer('my_tokenizer'))
    ->addCharacterFilter(new HtmlStripCharacterFilter('my_char_filter'))
    ->addTokenFilter(new LengthTokenFilter('my_token_filter'));
```

## Supported analyzers

* [Arabic analyzer](#arabic-analyzer)
* [Brazilian analyzer](#brazilian-analyzer)
* [Custom analyzer](#custom-analyzer)
* [English analyzer](#english-analyzer)
* [Fingerprint analyzer](#fingerprint-analyzer)
* [French analyzer](#french-analyzer)
* [German analyzer](#german-analyzer)
* [Hindi analyzer](#hindi-analyzer)
* [Italian analyzer](#italian-analyzer)
* [Pattern analyzer](#pattern-analyzer)
* [Portuguese analyzer](#portuguese-analyzer)
* [Russian analyzer](#russian-analyzer)
* [Spanish analyzer](#spanish-analyzer)
* [Standard analyzer](#standard-analyzer)
* [Stop analyser](#stop-analyser)
* [Swedish analyzer](#swedish-analyzer)
* [Turkish analyzer](#turkish-analyzer)

### Arabic analyzer

Learn more about arabic analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#arabic-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\ArabicAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new ArabicAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_ARABIC)
    ->addStemExclusion('مثال');
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');         
```

### Brazilian analyzer

Learn more about brazilian analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#brazilian-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\BrazilianAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new BrazilianAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_BRAZILIAN);
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');             
```

### Custom analyzer

Learn more about custom analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-custom-analyzer.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\CustomAnalyzer;
use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use BabenkoIvan\ElasticMate\Core\Contracts\Settings\CharacterFilter;
use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;

$analyzer = (new CustomAnalyzer('my_analyzer'))
    ->setTokenizer(Tokenizer::TYPE_WHITESPACE)
    ->addCharacterFilter(CharacterFilter::TYPE_HTML_STRIP)
    ->addTokenFilter(TokenFilter::TYPE_LOWER_CASE);
```

### English analyzer

Learn more about english analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#english-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\EnglishAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new EnglishAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_ENGLISH)
    ->addStemExclusion('Example');
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');             
```

### Fingerprint analyzer

Learn more about fingerprint analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-fingerprint-analyzer.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\FingerprintAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new FingerprintAnalyzer('my_analyzer'))
    ->setSeparator('|')
    ->setMaxOutputSize(128)
    ->setStopWords(Analysis::STOP_WORDS_ENGLISH);
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');             
```

### French analyzer

Learn more about french analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#french-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\FrenchAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new FrenchAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_FRENCH)
    ->addStemExclusion('Exemple');
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');     
```

### German analyzer

Learn more about german analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#german-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\GermanAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new GermanAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_GERMAN)
    ->addStemExclusion('Beispiel');
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');         
```

### Hindi analyzer

Learn more about hindi analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#hindi-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\HindiAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new HindiAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_HINDI)
    ->addStemExclusion('उदाहरण');
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');             
```

### Italian analyzer

Learn more about italian analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#italian-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\ItalianAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new ItalianAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_ITALIAN)
    ->addStemExclusion('esempio');
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');      
```

### Pattern analyzer

Learn more about pattern analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-pattern-analyzer.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\PatternAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new PatternAnalyzer('my_analyzer'))
    ->setPattern('([^\p{L}\d]+)')
    ->addFlag(Analysis::REGEXP_FLAG_CASE_INSENSITIVE)
    ->setLowerCased(false)
    ->setStopWords(collect(['at', 'on']));
```

### Portuguese analyzer

Learn more about portuguese analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#portuguese-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\PortugueseAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new PortugueseAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_PORTUGUESE)
    ->addStemExclusion('exemplo');
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');        
```

### Russian analyzer

Learn more about russian analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#russian-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\RussianAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new RussianAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_RUSSIAN)
    ->addStemExclusion('пример');
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');            
```

### Spanish analyzer

Learn more about spanish analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#spanish-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\SpanishAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new SpanishAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_SPANISH)
    ->addStemExclusion('ejemplo');
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');              
```

### Standard analyzer

Learn more about standard analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-standard-analyzer.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new StandardAnalyzer('my_analyzer'))
    ->setMaxTokenLength(128)
    ->setStopWords(Analysis::STOP_WORDS_ENGLISH);
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');       
```

### Stop analyser

Learn more about stop analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-stop-analyzer.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StopAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new StopAnalyzer('my_analyzer'))
    // you can use a predefined list
    ->setStopWords(Analysis::STOP_WORDS_ENGLISH)
    // or collection of words
    ->setStopWords(collect(['at', 'on']));
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');    
```

### Swedish analyzer

Learn more about swedish analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#swedish-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\SwedishAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new SwedishAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_SWEDISH)
    ->addStemExclusion('exempel');
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');       
```

### Turkish analyzer

Learn more about turkish analyzer in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-lang-analyzer.html#turkish-analyzer).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\TurkishAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$analyzer = (new TurkishAnalyzer('my_analyzer'))
    ->setStopWords(Analysis::STOP_WORDS_TURKISH)
    ->addStemExclusion('örnek');
    
// also you can set stop words from a file 
$analyzer->setStopWordsPath('/stopwords.txt');           
```

## Supported character filters

* [Html strip character filter](#html-strip-character-filter)
* [Mapping character filter](#mapping-character-filter)
* [Pattern replace character filter](#pattern-replace-character-filter)

### Html strip character filter

Learn more about html strip character filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-htmlstrip-charfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\HtmlStripCharacterFilter;

$characterFilter = (new HtmlStripCharacterFilter('my_char_filter'))
    ->addEscapedTag('b')
    ->addEscapedTag('a');
```

### Mapping character filter

Learn more about mapping character filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-mapping-charfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\MappingCharacterFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Support\CharacterMapping;

$characterFilter = (new MappingCharacterFilter('my_char_filter'))
    ->addMapping(new CharacterMapping('٠', '0'))
    ->addMapping(new CharacterMapping('١', '1'))
    ->addMapping(new CharacterMapping('٢', '2'));
```

### Pattern replace character filter

Learn more about pattern replace character filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-pattern-replace-charfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\PatternReplaceCharacterFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$characterFilter = (new PatternReplaceCharacterFilter('my_char_filter'))
    ->setPattern('(\\d+)-(?=\\d)')
    ->setReplacement('$1_')
    ->addFlag(Analysis::REGEXP_FLAG_CASE_INSENSITIVE);
```

## Supported token filters

* [Ascii folding token filter](#ascii-folding-token-filter)
* [Cjk bigram token filter](#cjk-bigram-token-filter)
* [Common grams token filter](#common-grams-token-filter)
* [Edge ngram token filter](#edge-ngram-token-filter)
* [Elision token filter](#elision-token-filter)
* [Fingerprint token filter](#fingerprint-token-filter)
* [Keep types token filter](#keep-types-token-filter)
* [Keep words token filter](#keep-words-token-filter)
* [Keyword maker token filter](#keyword-maker-token-filter)
* [Length token filter](#length-token-filter)
* [Limit token count token filter](#limit-token-filter)
* [Min hash token filter](#min-hash-token-filter)
* [Multiplexer token filter](#multiplexer-token-filter)
* [Ngram token filter](#ngram-token-filter)
* [Pattern capture token filter](#pattern-capture-token-filter)
* [Pattern replace token filter](#pattern-replace-token-filter)
* [Shingle token filter](#shingle-token-filter)
* [Snow ball token filter](#snow-ball-token-filter)
* [Stemmer override token filter](#stemmer-override-token-filter)
* [Stemmer token filter](#stemmer-token-filter)
* [Stop token filter](#stop-token-filter)
* [Synonym token filter](#synonym-token-filter)
* [Truncate token filter](#truncate-token-filter)
* [Unique token filter](#unique-token-filter)
* [Word delimiter graph token filter](#word-delimiter-graph-token-filter)
* [Word delimiter token filter](#word-delimiter-token-filter)

### Ascii folding token filter

Learn more about ascii folding token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-asciifolding-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AsciiFoldingTokenFilter;

$tokenFilter = (new AsciiFoldingTokenFilter('my_token_filter'))
    ->setPreserveOriginal(true);
```

### Cjk bigram token filter

Learn more about cjk bigram token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-cjk-bigram-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\CjkBigramTokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$tokenFilter = (new CjkBigramTokenFilter('my_token_filter'))
    ->setOutputUnigrams(false)
    ->addIgnoredScript(Analysis::SCRIPT_HANGUL)
    ->addIgnoredScript(Analysis::SCRIPT_KATAKANA);
```

### Common grams token filter

Learn more about common grams token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-common-grams-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\CommonGramsTokenFilter;

$tokenFilter = (new CommonGramsTokenFilter('my_token_filter'))
    ->addCommonWord('a')
    ->addCommonWord('an')
    ->setIgnoreCase(true)
    ->setQueryMode(true);
    
// also you can set common words from a file
$tokenFilter->setCommonWordsPath('/common_words.txt');
```

### Edge ngram token filter

Learn more about edge ngram token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-edgengram-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\EdgeNgramTokenFilter;

$tokenFilter = (new EdgeNgramTokenFilter('my_token_filter'))
    ->setMinGram(3)
    ->setMaxGram(8);
```

### Elision token filter

Learn more about elision token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-elision-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\ElisionTokenFilter;

$tokenFilter = (new ElisionTokenFilter('my_token_filter'))
    ->addArticle('l')
    ->addArticle('m');
```

### Fingerprint token filter

Learn more about fingerprint token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-fingerprint-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\FingerprintTokenFilter;

$tokenFilter = (new FingerprintTokenFilter('my_token_filter'))
    ->setSeparator(' ')
    ->setMaxOutputSize(255);
```

### Keep types token filter

Learn more about keep types token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-keep-types-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\KeepTypesTokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$tokenFilter = (new KeepTypesTokenFilter('my_token_filter'))
    ->setMode(Analysis::MODE_EXCLUDE)
    ->addType('<NUM>');
```

### Keep words token filter

Learn more about keep words token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-keep-words-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\KeepWordsTokenFilter;

$tokenFilter = (new KeepWordsTokenFilter('my_token_filter'))
    ->setKeepWordsCase(true)
    ->addKeepWord('one')
    ->addKeepWord('two');
    
// also you can set words from a file
$tokenFilter->setKeepWordsPath('/keep_words.txt');
```

### Keyword maker token filter

Learn more about keyword maker token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-keyword-marker-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\KeywordMakerTokenFilter;

$tokenFilter = (new KeywordMakerTokenFilter('my_token_filter'))
    ->setIgnoreCase(true)
    ->setKeywordsPattern('\w+');
```

### Length token filter

Learn more about length token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-length-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\LengthTokenFilter;

$tokenFilter = (new LengthTokenFilter('my_token_filter'))
    ->setMin(0)
    ->setMax(2147483647);
```

### Limit token count token filter

Learn more about limit token count token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-limit-token-count-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\LimitTokenCountTokenFilter;

$tokenFilter = (new LimitTokenCountTokenFilter('my_token_filter'))
    ->setMaxTokenCount(5)
    ->setConsumeAllTokens(true);
```

### Min hash token filter

Learn more about min hash token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-minhash-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\MinHashTokenFilter;

$tokenFilter = (new MinHashTokenFilter('my_token_filter'))
    ->setHashCount(10)
    ->setBucketCount(1024)
    ->setHashSetSize(5)
    ->setWithRotation(false);
```

### Multiplexer token filter

Learn more about multiplexer token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-multiplexer-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\MultiplexerTokenFilter;

$tokenFilter = (new MultiplexerTokenFilter('my_token_filter'))
    ->setPreserveOriginal(false)
    ->addFilter(TokenFilter::TYPE_LOWER_CASE)
    ->addFilter(TokenFilter::TYPE_PORTER_STEM);
```

### Ngram token filter

Learn more about ngram token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-ngram-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\NgramTokenFilter;

$tokenFilter = (new NgramTokenFilter('my_token_filter'))
    ->setMinGram(1)
    ->setMaxGram(2);
```

### Pattern capture token filter

Learn more about pattern capture token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-pattern-capture-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\PatternCaptureTokenFilter;

$tokenFilter = (new PatternCaptureTokenFilter('my_token_filter'))
    ->setPreserveOriginal(true)
    ->addPattern('(\p{Ll}+|\p{Lu}\p{Ll}+|\p{Lu}+)')
    ->addPattern('(\d+)');
```

### Pattern replace token filter

Learn more about pattern replace token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-pattern_replace-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\PatternReplaceTokenFilter;

$tokenFilter = (new PatternReplaceTokenFilter('my_token_filter'))
    ->setPattern('\n')
    ->setReplacement('\t')
```

### Shingle token filter

Learn more about shingle token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-shingle-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\ShingleTokenFilter;

$tokenFilter = (new ShingleTokenFilter('my_token_filter'))
    ->setMinShingleSize(2)
    ->setMaxShingleSize(3)
    ->setOutputUnigrams(false)
    ->setOutputUnigramsIfNoShingles(true)
    ->setTokenSeparator(' ')
    ->setFillerToken('_');
```

### Snow ball token filter

Learn more about snow ball token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-snowball-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\SnowBallTokenFilter;

$tokenFilter = (new SnowBallTokenFilter('my_token_filter'))
    ->setLanguage(Analysis::LANGUAGE_GERMAN);
```

### Stemmer override token filter

Learn more about stemmer override token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-stemmer-override-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\StemmerOverrideTokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Support\StemmingRule;

$tokenFilter = (new StemmerOverrideTokenFilter('my_token_filter'))
    ->addRule(new StemmingRule('running', 'run'))
    ->addRule(new StemmingRule('stemmer', 'stemmer'));
    
// also you can set rules from a file
$tokenFilter->setRulesPath('/rules.txt');    
```

### Stemmer token filter

Learn more about stemmer token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-stemmer-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\StemmerTokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$tokenFilter = (new StemmerTokenFilter('my_token_filter'))
    ->setLanguage(Analysis::LANGUAGE_LIGHT_ENGLISH);
```

### Stop token filter

Learn more about stop token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-stop-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\StopTokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;

$tokenFilter = (new StopTokenFilter('my_token_filter'))
    ->setIgnoreCase(true)
    ->setRemoveTrailing(false)
    ->setStopWords(Analysis::STOP_WORDS_ENGLISH);
    
// also you can set stop words from a file
$tokenFilter->setStopWordsPath('/stopwords.txt')    
```

### Synonym token filter

Learn more about synonym token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-synonym-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\SynonymTokenFilter;

$tokenFilter = (new SynonymTokenFilter('my_token_filter'))
    ->setExpand(false)
    ->setLenient(true)
    ->setSynonyms('i-pod', collect(['i pod', 'ipod']))
    ->setSynonyms('universe', collect(['cosmos']));
```

### Truncate token filter

Learn more about truncate token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-truncate-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\TruncateTokenFilter;

$tokenFilter = (new TruncateTokenFilter('my_token_filter'))
    ->setLength(10);
```

### Unique token filter

Learn more about unique token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-unique-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\UniqueTokenFilter;

$tokenFilter = (new UniqueTokenFilter('my_token_filter'))
    ->setOnlyOnSamePosition(false);
```

### Word delimiter graph token filter

Learn more about word delimiter graph token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-word-delimiter-graph-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\WordDelimiterGraphTokenFilter;

$tokenFilter = (new WordDelimiterGraphTokenFilter('my_token_filter'))
    ->setGenerateWordParts(false)
    ->setGenerateNumberParts(false)
    ->setCatenateWords(true)
    ->setCatenateNumbers(true)
    ->setCatenateAll(true)
    ->setSplitOnCaseChange(false)
    ->setPreserveOriginal(true)
    ->setSplitOnNumerics(false)
    ->setStemEnglishPossessive(false)
    ->addProtectedWord('one')
    ->addProtectedWord('two');
    
// also you can set protected words from a file
$tokenFilter->setProtectedWordsPath('/protected_words.txt');
```

### Word delimiter token filter

Learn more about word delimiter token filter in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis-word-delimiter-tokenfilter.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\WordDelimiterTokenFilter;

$tokenFilter = (new WordDelimiterTokenFilter('my_token_filter'))
    ->setGenerateWordParts(false)
    ->setGenerateNumberParts(false)
    ->setCatenateWords(true)
    ->setCatenateNumbers(true)
    ->setCatenateAll(true)
    ->setSplitOnCaseChange(false)
    ->setPreserveOriginal(true)
    ->setSplitOnNumerics(false)
    ->setStemEnglishPossessive(false)
    ->addProtectedWord('one')
    ->addProtectedWord('two');
```
