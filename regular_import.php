#!env php
<?php
require_once './src/DataGenerator.php';
require_once './src/BaseImporter.php';
require_once './src/ImportDemo.php';

$importer = new ImportDemo(new DataGenerator());

$importer->doImport();
