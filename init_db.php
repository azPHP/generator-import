#!/usr/bin/env php
<?php

$db = new PDO('mysql:host=127.0.0.1;port=3306', 'root', 'root');
$db->exec('CREATE DATABASE mydb');

$db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=mydb', 'root', 'root');
$db->exec(<<<SQL
CREATE TABLE people (
  identifier CHAR(64),
  first_name VARCHAR(64),
  last_name VARCHAR(64),
  birthday DATE,
  description TEXT
)
SQL
);

echo "mydb database and people table initialized";