<?php

 
require 'vendor/autoload.php';

$userName="taoclass_root";
$password="suleimanonoruoyiza";
$databaseName="taoclass_whitelab";

Spatie\DbDumper\Databases\MySql::create()
    ->setDbName($databaseName)
    ->setUserName($userName)
    ->setPassword($password)
    ->includeTables(['table1'])
    ->dumpToFile('dump.sql');
?>