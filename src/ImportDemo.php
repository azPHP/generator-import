<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 7/9/16
 * Time: 11:18 AM
 */
class ImportDemo extends BaseImporter
{
    const IMPORT_LENGTH = 25000;

    public function doImport()
    {
        $startTime = time();
        $stmt = $this->pdo->prepare(<<<SQL
INSERT INTO people (identifier, first_name, last_name, birthday, description) VALUES (?, ?, ?, ?, ?)
SQL
        );
//        $this->pdo->beginTransaction();

        for ($i=0;$i<self::IMPORT_LENGTH;$i++) {
            $data = $this->data->current();
            $stmt->execute(array_values($data));
            if ($i % 500 === 0) {
                echo '.';
            }
            $this->data->next();
        }

//        $this->pdo->commit();
        echo "\n\n";

        $endTime = time();

        echo "Took " . ($endTime - $startTime) . ' seconds for ' . self::IMPORT_LENGTH . " items\n\n";
        echo "Ate ".memory_get_peak_usage()." bytes\n";
    }
}