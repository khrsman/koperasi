<?php
$dbhost ='localhost';
$dbuser ='cimahifi_admin';
$dbpass ='[3SzP;5cyn!U';
$dbname ='cimahifi_db';
$db_dsn = "mysql:dbname=$dbname;host=$dbhost";
try {
  $db = new PDO($db_dsn, $dbuser, $dbpass);
} catch (PDOException $e) {
  echo 'Connection failed: '.$e->getMessage();
}