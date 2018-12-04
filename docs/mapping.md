# Mapping

Learn more about mapping in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/mapping.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;

$mapping = (new Mapping())
    ->setSourceEnabled(true)
    ->addProperty(new TextProperty('message'));
```

## Supported properties

* [Alias property](#alias-property)
* [Binary property](#binary-property)
* [Boolean property](#boolean-property)
* [Byte numeric property](#byte-numeric-property)
* [Date property](#date-property)
* [Date range property](#date-range-property)
* [Double numeric property](#double-numeric-property)
* [Double range property](#double-range-property)
* [Float numeric property](#float-numeric-property)
* [Float range property](#float-range-property)
* [Geo point property](#geo-point-property)
* [Half float numeric property](#half-float-numeric-property)
* [Integer numeric property](#integer-numeric-property)
* [Integer range property](#integer-range-property)
* [Ip property](#ip-property)
* [Ip range property](#ip-range-property)
* [Keyword property](#keyword-property)
* [Long numeric property](#long-numeric-property)
* [Long range property](#long-range-property)
* [Scaled float numeric property](#scaled-float-numeric-property)
* [Short numeric property](#short-numeric-property)
* [Text property](#text-property)

### Alias property

Learn more about alias property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/alias.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\AliasProperty;

$textProperty = new TextProperty('message');
$aliasProperty = new AliasProperty('msg', 'message');
```

### Binary property

Learn more about binary property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/binary.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\BinaryProperty;

$property = (new BinaryProperty('blob'))
    ->setDocValues(true)
    ->setStore(true);
```

### Boolean property

Learn more about boolean property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/boolean.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\BooleanProperty;

$property = (new BooleanProperty('is_published'))
    ->setDocValues(true)
    ->setStore(true)
    ->setIndex(false)
    ->setNullValue(false)
    ->setBoost(1.1);
```

### Byte numeric property

Learn more about byte numeric property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/number.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\ByteNumericProperty;

$property = (new ByteNumericProperty('memory'))
    ->setCoerce(false)
    ->setBoost(1.7)
    ->setDocValues(false)
    ->setIgnoreMalformed(true)
    ->setIndex(false)
    ->setNullValue(0)
    ->setStore(true);
```

### Date property

Learn more about date property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/date.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\DateProperty;

$property = (new DateProperty('created'))
    ->setBoost(1.2)
    ->setDocValues(false)
    ->setFormat('yyyy-MM-dd HH:mm:ss')
    ->setLocale('en')
    ->setIgnoreMalformed(true)
    ->setIndex(false)
    ->setNullValue('2000-01-01 00:00:00')
    ->setStore(true);
```

### Date range property

Learn more about date range property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/range.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\DateRangeProperty;

$property = (new DateRangeProperty('time_frame'))
    ->setCoerce(false)
    ->setBoost(1.2)
    ->setIndex(false)
    ->setStore(true)
    ->setFormat('yyyy-MM-dd HH:mm:ss')
    ->setLocale('en');
```

### Double numeric property

Learn more about double numeric property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/number.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\DoubleNumericProperty;
 
$property = (new DoubleNumericProperty('price'))
    ->setCoerce(false)
    ->setBoost(1.7)
    ->setDocValues(false)
    ->setIgnoreMalformed(true)
    ->setIndex(false)
    ->setNullValue(0)
    ->setStore(true);
```

### Double range property

Learn more about double range property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/range.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\DoubleRangeProperty;

$property = (new DoubleRangeProperty('price'))
    ->setCoerce(false)
    ->setBoost(1.2)
    ->setIndex(false)
    ->setStore(true);
```

### Float numeric property

Learn more about float numeric property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/number.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\FloatNumericProperty;

$property = (new FloatNumericProperty('price'))
    ->setCoerce(false)
    ->setBoost(1.7)
    ->setDocValues(false)
    ->setIgnoreMalformed(true)
    ->setIndex(false)
    ->setNullValue(0)
    ->setStore(true);
```

### Float range property

Learn more about float range property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/range.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\FloatRangeProperty;

$property = (new FloatRangeProperty('price'))
    ->setCoerce(false)
    ->setBoost(1.2)
    ->setIndex(false)
    ->setStore(true);
```

### Geo point property

Learn more about geo point property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/geo-point.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\GeoPointProperty;
use BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint;

$property = (new GeoPointProperty('location'))
    ->setIgnoreMalformed(true)
    ->setIgnoreZValue(false)
    ->setNullValue(new GeoPoint(0, 0));
```

### Half float numeric property

Learn more about half float numeric property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/number.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\HalfFloatNumericProperty;

$property = (new HalfFloatNumericProperty('price'))
    ->setCoerce(false)
    ->setBoost(1.7)
    ->setDocValues(false)
    ->setIgnoreMalformed(true)
    ->setIndex(false)
    ->setNullValue(0)
    ->setStore(true);
```

### Integer numeric property

Learn more about integer numeric property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/number.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\IntegerNumericProperty;

$property = (new IntegerNumericProperty('students'))
    ->setCoerce(false)
    ->setBoost(1.7)
    ->setDocValues(false)
    ->setIgnoreMalformed(true)
    ->setIndex(false)
    ->setNullValue(0)
    ->setStore(true);
```

### Integer range property

Learn more about integer range property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/range.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\IntegerRangeProperty;

$property = (new IntegerRangeProperty('students'))
    ->setCoerce(false)
    ->setBoost(1.2)
    ->setIndex(false)
    ->setStore(true);
```

### Ip property

Learn more about ip property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/ip.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\IpProperty;

$property = (new IpProperty('host'))
    ->setDocValues(false)
    ->setStore(false)
    ->setIndex(true)
    ->setNullValue('0.0.0.0')
    ->setBoost(1.2);
```

### Ip range property

Learn more about ip range property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/range.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\IpRangeProperty;

$property = (new IpRangeProperty('foo'))
    ->setCoerce(false)
    ->setBoost(1.2)
    ->setIndex(false)
    ->setStore(true);
```

### Keyword property

Learn more about keyword property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/keyword.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\KeywordProperty;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;

$property = (new KeywordProperty('color'))
    ->setDocValues(false)
    ->setStore(true)
    ->setIndex(false)
    ->setEagerGlobalOrdinals(true)
    ->setIgnoreAbove(1028)
    ->setIndexOptions(Mapping::INDEX_OPTIONS_DOCS)
    ->setSimilarity(Mapping::SIMILARITY_CLASSIC)
    ->setNorms(false)
    ->setSplitQueriesOnWhitespace(false)
    ->setNullValue('white')
    ->setBoost(1.6);
```

### Long numeric property

Learn more about long numeric property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/number.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\LongNumericProperty;

$property = (new LongNumericProperty('price'))
    ->setCoerce(false)
    ->setBoost(1.7)
    ->setDocValues(false)
    ->setIgnoreMalformed(true)
    ->setIndex(false)
    ->setNullValue(0)
    ->setStore(true);
```

### Long range property

Learn more about long range property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/range.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\LongRangeProperty;

$property = (new LongRangeProperty('price'))
    ->setCoerce(false)
    ->setBoost(1.2)
    ->setIndex(false)
    ->setStore(true);
```

### Scaled float numeric property

Learn more about scaled float numeric property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/number.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\ScaledFloatNumericProperty;

$property = (new ScaledFloatNumericProperty('price'))
    ->setCoerce(false)
    ->setBoost(1.7)
    ->setDocValues(false)
    ->setIgnoreMalformed(true)
    ->setIndex(false)
    ->setNullValue(0)
    ->setStore(true)
    ->setScalingFactor(100);
```

### Short numeric property

Learn more about short numeric property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/number.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\ShortNumericProperty;

$property = (new ShortNumericProperty('price'))
    ->setCoerce(false)
    ->setBoost(1.7)
    ->setDocValues(false)
    ->setIgnoreMalformed(true)
    ->setIndex(false)
    ->setNullValue(0)
    ->setStore(true);
```

### Text property 

Learn more about text property in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/text.html).

```php
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;

$property = (new TextProperty('message'))
    ->setBoost(1.7)
    ->setEagerGlobalOrdinals(false)
    ->setFieldData(true)
    ->setIndex(false)
    ->setIndexOptions(Mapping::INDEX_OPTIONS_DOCS)
    ->setNorms(true)
    ->setStore(true)
    ->setSimilarity(Mapping::SIMILARITY_CLASSIC)
    ->setTermVector(Mapping::TERM_VECTOR_WITH_POSITIONS_AND_OFFSETS)
    ->setAnalyzer('whitespace')
    ->setSearchAnalyzer('standard')
    ->setSearchQuoteAnalyzer('simple');
```
