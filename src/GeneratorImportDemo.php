<?php

/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 7/9/16
 * Time: 12:23 PM
 */
class GeneratorImportDemo extends BaseImporter
{
    const IMPORT_LENGTH = 25000;
    const INSERT_COUNT = 500;

    /**
     * @var Generator
     */
    protected $inserter;

    public function __construct(DataGenerator $dataGenerator)
    {
        parent::__construct($dataGenerator);
        $this->inserter = $this->insertGenerator();
    }

    public function doImport()
    {
        $startTime = time();
        for ($i=0;$i<self::IMPORT_LENGTH;$i++) {
            $data = $this->data->current();
            $this->inserter->send($data);

            if ($i % self::INSERT_COUNT === 0) {
                $this->inserter->send(true);
                echo '.';
            }
            $this->data->next();
        }
        // always shutdown our generator
        $this->inserter->send(false);

        $endTime = time();

        echo "Took " . ($endTime - $startTime) . ' seconds for ' . self::IMPORT_LENGTH . " items\n\n";
        echo "Ate ".memory_get_peak_usage()." bytes\n";
    }

    /**
     * @return Generator
     */
    protected function insertGenerator()
    {
        $insertData = [];
        $insertQuery = [];
        while ($data = yield) {
            if ($data === true) {
                $this->doInsert($insertQuery, $insertData);
                $insertData = [];
                $insertQuery = [];
            } else {
                foreach ($data as $value) {
                    $insertData[] = $value;
                }
                $insertQuery[] = '(?, ?, ?, ?, ?)';
            }
        }
        // any leftovers?
        if (!empty($insertData)) {
            $this->doInsert($insertQuery, $insertData);
        }
    }

    protected function doInsert($queries, $values)
    {
        $sql = 'INSERT INTO people (
             identifier,
             first_name,
             last_name,
             birthday,
             description
        ) VALUES ';
        $sql .= implode(', ', $queries);

        $stmt = $this->pdo->prepare($sql);
        $this->pdo->beginTransaction();
        $stmt->execute($values);
        $this->pdo->commit();
    }
}