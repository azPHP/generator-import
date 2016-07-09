#!env php
<?php
require_once './src/DataGenerator.php';
require_once './src/BaseImporter.php';
require_once './src/GeneratorImportDemo.php';

$importer = new GeneratorImportDemo(new DataGenerator());

$importer->doImport();
