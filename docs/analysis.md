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


