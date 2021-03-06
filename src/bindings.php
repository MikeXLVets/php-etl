<?php

use Marquine\Etl\Container;

$container = Container::getInstance();

// Database
$container->singleton(Marquine\Etl\Database\Manager::class);

// Extractors
$container->bind('extractor.array', Marquine\Etl\Extractors\Arr::class);
$container->bind('extractor.csv', Marquine\Etl\Extractors\Csv::class);
$container->bind('extractor.fixed_width', Marquine\Etl\Extractors\FixedWidth::class);
$container->bind('extractor.json', Marquine\Etl\Extractors\Json::class);
$container->bind('extractor.query', Marquine\Etl\Extractors\Query::class);
$container->bind('extractor.table', Marquine\Etl\Extractors\Table::class);
$container->bind('extractor.xml', Marquine\Etl\Extractors\Xml::class);

// Transformers
$container->bind('transformer.json_encode', Marquine\Etl\Transformers\JsonEncode::class);
$container->bind('transformer.trim', Marquine\Etl\Transformers\Trim::class);

// Loaders
$container->bind('loader.insert', Marquine\Etl\Loaders\Insert::class);
$container->bind('loader.insert_update', Marquine\Etl\Loaders\InsertUpdate::class);
