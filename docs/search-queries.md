# Supported queries

* [Bool query](#bool-query)
* [Exists query](#exists-query)
* [Fuzzy query](#fuzzy-query)
* [Geo bounding box query](#geo-bounding-box-query)
* [Geo distance query](#geo-distance-query)
* [Match all query](#match-all-query)
* [Match phrase prefix query](#match-phrase-prefix-query)
* [Match phrase query](#match-phrase-query)
* [Match query](#match-query)
* [Prefix query](#prefix-query)
* [Range query](#range-query)
* [Regexp query](#regexp-query)
* [Term query](#term-query)
* [Terms query](#terms-query)
* [Wildcard query](#wildcard-query)

## Bool query

Learn more about bool query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-bool-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\BoolQuery;
use BabenkoIvan\ElasticMate\Core\Content\Types\Range;
use BabenkoIvan\ElasticMate\Core\Search\Queries\MatchQuery;
use BabenkoIvan\ElasticMate\Core\Search\Queries\TermQuery;

$query = (new BoolQuery())
    ->addMust(new RangeQuery('age', collect([new Range(18, Range::TYPE_GREATER_THAN)])))
    ->addMustNot(new MatchQuery('name', 'John'))
    ->addShould(new TermQuery('language', 'english'))
    ->addShould(new TermQuery('language', 'german'))
    ->setMinimumShouldMatch(1)
    ->addFilter(new TermQuery('gender', 'male'));
```

## Exists query

Learn more about exists query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-exists-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\ExistsQuery;

$query = new ExistsQuery('mobile');
```

## Fuzzy query

Learn more about fuzzy query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-fuzzy-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\FuzzyQuery;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\AutoFuzziness;

$query = (new FuzzyQuery('maker', 'aplpe'))
    // supported types are AutoFuzziness and ExactFuzziness
    ->setFuzziness(new AutoFuzziness(1, 2, true))
    ->setPrefixLength(1)
    ->setMaxExpansions(5)
    ->setBoost(1.2);
```

## Geo bounding box query

Learn more about geo bounding box query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-geo-bounding-box-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint;
use BabenkoIvan\ElasticMate\Core\Search\Queries\GeoBoundingBoxQuery;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;

$topLeftPoint = new GeoPoint(40.73, -74.1);
$bottomRightPoint = new GeoPoint(40.10, -71.12);

$query = (new GeoBoundingBoxQuery('location', $topLeftPoint, $bottomRightPoint))
    ->setValidationMethod(Query::VALIDATION_METHOD_COERCE)
    ->setType(Query::EXECUTION_TYPE_INDEXED);
```

## Geo distance query

Learn more about geo distance query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-geo-distance-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint;
use BabenkoIvan\ElasticMate\Core\Content\Types\GeoDistance;
use BabenkoIvan\ElasticMate\Core\Search\Queries\GeoDistanceQuery;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;

$point = new GeoPoint(40, -70);
$distance = new GeoDistance(12, GeoDistance::UNIT_KILOMETER);

$query = (new GeoDistanceQuery('location', $point, $distance))
    ->setDistanceType(Query::DISTANCE_TYPE_PLANE)
    ->setValidationMethod(Query::VALIDATION_METHOD_IGNORE_MALFORMED);
```

## Match all query

Learn more about match all query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-match-all-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\MatchAllQuery;

$query = new MatchAllQuery();
```

## Match phrase prefix query

Learn more about match phrase prefix query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-match-query-phrase-prefix.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\MatchPhrasePrefixQuery;

$query = (new MatchPhrasePrefixQuery('message', 'quick brown f'))
    ->setMaxExpansions(40);
```

## Match phrase query

Learn more about match phrase query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-match-query-phrase.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\MatchPhraseQuery;
use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;

$query = (new MatchPhraseQuery('message', 'this is a test'))
    ->setAnalyzer(Analyzer::TYPE_WHITESPACE)
    ->setSlop(2);
```

## Match query

Learn more about match query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-match-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\MatchQuery;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Fuzziness\ExactFuzziness;

$query = (new MatchQuery('message', 'this is a test'))
    ->setOperator(Query::OPERATOR_AND)
    ->setLenient(true)
    ->setPrefixLength(2)
    ->setMaxExpansions(40)
    ->setAnalyzer(Analyzer::TYPE_WHITESPACE)
    ->setFuzziness(new ExactFuzziness(2, true))
    ->setCutoffFrequency(0.01);
```

## Prefix query

Learn more about prefix query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-prefix-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\PrefixQuery;

$query = (new PrefixQuery('user', 'ki'))
    ->setBoost(1.7);
```

## Range query

Learn more about range query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-range-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Content\Types\Range;
use BabenkoIvan\ElasticMate\Core\Search\Queries\RangeQuery;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;

$range = collect([
    new Range('01/01/2012', Range::TYPE_GREATER_THAN),
    new Range('01/01/2015', Range::TYPE_LESS_THAN)
]);

$query = (new RangeQuery('created', $range))
    ->setFormat('dd/MM/yyyy')
    ->setTimezone('+01:00')
    ->setRelation(Query::RELATION_WITHIN)
    ->setBoost(1.9);
```

## Regexp query

Learn more about regexp query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-regexp-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\RegexpQuery;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;

$query = (new RegexpQuery('name', 's.*y'))
    ->setMaxDeterminizedStates(20000)
    ->addFlag(Query::REGEXP_FLAG_EMPTY)
    ->addFlag(Query::REGEXP_FLAG_INTERSECTION)
    ->setBoost(1.6);
```

## Term query

Learn more about term query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-term-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\TermQuery;

$query = (new TermQuery('status', 'ready'))
    ->setBoost(1.5);
```

## Terms query

Learn more about terms query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-terms-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\TermsQuery;

$query = new TermsQuery('status', collect(['ready', 'processed']));
```

## Wildcard query

Learn more about wildcard query in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-wildcard-query.html).

```php
use BabenkoIvan\ElasticMate\Core\Search\Queries\WildcardQuery;

$query = (new WildcardQuery('status', 're*y'))
    ->setBoost(1.3);
```
