#!env php
<?php
require_once './src/DataGenerator.php';
require_once './src/ImportDemo.php';

$importer = new ImportDemo(new DataGenerator());

$startTime = time();
$importer->doImport();
$endTime = time();

echo "Took " . ($endTime - $startTime) . " seconds\n";
