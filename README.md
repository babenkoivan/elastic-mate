# Elastic Mate

[![Build Status](https://travis-ci.com/babenkoivan/elastic-mate.svg?branch=dev)](https://travis-ci.com/babenkoivan/elastic-mate)

---

## Contents

* [Installation](#installation)
* [Configuration](#configuration)
* [Index actions](#index-actions)
* [Document actions](#document-actions)
    
## Installation

## Configuration

## Index actions

### Create

Learn more about index creation in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-create-index.html).

```php
use BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Settings;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use BabenkoIvan\ElasticMate\Core\Entities\Index;

// create Elastic Search client instance
$client = ClientFactory::fromConfig([
  'hosts' => [
      'localhost:9200'
  ]
]);

// pass client to an index manager
$indexManager = new IndexManager($client);

// configure your index
$analysis = (new Analysis())
    ->addAnalyzer(new StandardAnalyzer('content_analyzer'));
    
$settings = (new Settings())
    ->setNumberOfShards(1)
    ->setAnalysis($analysis);

$mapping = (new Mapping())
    ->setSourceEnabled(false)
    ->addProperty((new TextProperty('content'))->setAnalyzer('content_analyzer'));

$index = (new Index('my_index'))
    ->setSettings($settings)
    ->setMapping($mapping);

// create the index
$indexManager->create($index);
```

Read more about supported [settings](docs/settings.md) and [mapping](docs/mapping.md). 

### Update settings

Learn more about index settings update in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-update-settings.html).

```php
use BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer;

// create Elastic Search client instance
$client = ClientFactory::fromConfig([
  'hosts' => [
      'localhost:9200'
  ]
]);

// pass client to an index manager
$indexManager = new IndexManager($client);

// configure your index settings
$analysis = (new Analysis())
    ->addAnalyzer(new StandardAnalyzer('content_analyzer'));
    
$index->getSettings()
    ->setAnalysis($analysis);

// update the index settings
$indexManager->updateSettings($index);

// you can force settings update, that will cause index closing and opening it again after update
$indexManager->updateSettings($index, true);
```

Read more about supported [settings](docs/settings.md).

### Update mapping

Learn more about mapping update in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-put-mapping.html).

```php
use BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;

// create Elastic Search client instance
$client = ClientFactory::fromConfig([
  'hosts' => [
      'localhost:9200'
  ]
]);

// pass client to an index manager
$indexManager = new IndexManager($client);

// configure your index mapping
$index->getMapping()
    ->addProperty(new TextProperty('content'));

// update the index mapping
$indexManager->updateMapping($index);
```

Read more about supported [mapping properties](docs/mapping.md). 

### Delete

Learn more about index deletion in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-delete-index.html).

```php
use BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory;
use BabenkoIvan\ElasticMate\Core\EntityManagers\IndexManager;

// create Elastic Search client instance
$client = ClientFactory::fromConfig([
  'hosts' => [
      'localhost:9200'
  ]
]);

// pass client to an index manager
$indexManager = new IndexManager($client);

// delete an index
$indexManager->delete($index);
```

## Document actions

### Index

Learn more about document index API in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/docs-index_.html).

```php
use BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory;
use BabenkoIvan\ElasticMate\Core\EntityManagers\BulkDocumentManager;
use BabenkoIvan\ElasticMate\Core\Entities\Document;
use BabenkoIvan\ElasticMate\Core\Content\Content;

// create Elastic Search client instance
$client = ClientFactory::fromConfig([
  'hosts' => [
      'localhost:9200'
  ]
]);

// pass client to a document manager
$documentManager = new BulkDocumentManager($client);

// define your documents
$documents = collect([
    new Document('1', new Content(['name' => 'foo'])),
    new Document('2', new Content(['name' => 'bar']))
]);

// index the documents
$documentManager->index($index, $documents);

// you can force document indexation, that will cause immidiate index refresh
$documentManager->index($index, $documents, true);
```

### Delete

Learn more about document delete API in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/docs-delete.html).

```php
use BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory;
use BabenkoIvan\ElasticMate\Core\EntityManagers\BulkDocumentManager;

// create Elastic Search client instance
$client = ClientFactory::fromConfig([
  'hosts' => [
      'localhost:9200'
  ]
]);

// pass client to a document manager
$documentManager = new BulkDocumentManager($client);

// delete the documents
$documentManager->delete($index, $documents);

// you can force document deletion, that will cause immidiate index refresh
$documentManager->delete($index, $documents, true);
```

### Search

Learn more about search API in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/search.html).

```php
use BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory;
use BabenkoIvan\ElasticMate\Core\EntityManagers\BulkDocumentManager;
use BabenkoIvan\ElasticMate\Core\Search\Queries\MatchAllQuery;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\SimpleSort;
use BabenkoIvan\ElasticMate\Core\Search\Sort\Simple\FieldSort;
use BabenkoIvan\ElasticMate\Core\Search\Pagination;
use BabenkoIvan\ElasticMate\Core\Search\Request;

// create Elastic Search client instance
$client = ClientFactory::fromConfig([
  'hosts' => [
      'localhost:9200'
  ]
]);

// pass client to a document manager
$documentManager = new BulkDocumentManager($client);

// create a search query
$query = new MatchAllQuery();

// define the way your want documents to be sorted
$sort = new SimpleSort(collect([
    new FieldSort('_id', 'asc')
]));

// specify from and size parameters for pagination
$pagination = new Pagination(20, 10);

// create a search request
$request = (new Request($query))
    ->setSort($sort)
    ->setPagination($pagination);

// execute the request and receive a search result
$response = $documentManager->search($index, $request);

// get documents from response
$response->getDocuments();

// get number of documents, that satisfy the query
$response->getTotal();
```

Read more about supported [search queries](docs/search-queries.md). 
