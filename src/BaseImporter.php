<?php

/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 7/9/16
 * Time: 12:30 PM
 */
abstract class BaseImporter
{
    /**
     * @var Generator
     */
    protected $data;

    public function __construct(\DataGenerator $dataGenerator)
    {
        $this->data = $dataGenerator->dataMaker();
        $this->pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=mydb', 'root', 'root');
    }

    abstract public function doImport();
}