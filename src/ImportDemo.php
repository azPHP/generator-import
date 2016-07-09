<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 7/9/16
 * Time: 11:18 AM
 */
class ImportDemo
{
    const IMPORT_LENGTH = 25000;

    /**
     * @var Generator
     */
    private $data;

    public function __construct(\DataGenerator $dataGenerator)
    {
        $this->data = $dataGenerator->dataMaker();
        $this->pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=mydb', 'root', 'root');
    }

    public function doImport()
    {
        $stmt = $this->pdo->prepare(<<<SQL
INSERT INTO people (identifier, first_name, last_name, birthday, description) VALUES (?, ?, ?, ?, ?)
SQL
        );
        $this->pdo->beginTransaction();

        for ($i=0;$i<self::IMPORT_LENGTH;$i++) {
            $data = $this->data->current();
            $stmt->execute(array_values($data));
            if ($i % 500 === 0) {
                echo '.';
            }
        }

        $this->pdo->commit();
        echo "\n\n";
    }
}