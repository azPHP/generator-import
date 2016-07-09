<?php

/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 7/9/16
 * Time: 11:19 AM
 */
class DataGenerator
{
    /**
     * @return Generator
     */
    public function dataMaker()
    {
        while (true) {
            yield [
                'identifier' => $this->randomString(64),
                'first_name' => $this->randomString(10),
                'last_name' => $this->randomString(15),
                'birthday' => date('Y-m-d H:i:s'),
                'description' => $this->randomString(),
            ];
        }
    }

    public function randomString($length = false)
    {
        if (!$length) {
            $length = rand(10, 4096);
        }
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randstring;
    }
}