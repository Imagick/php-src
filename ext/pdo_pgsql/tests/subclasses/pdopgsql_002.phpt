--TEST--
PdoPgsql connect through PDO::connect
--EXTENSIONS--
pdo_mysql
--SKIPIF--
<?php
# This does not need to be executed by the redirect as we directly test
# the ::connect() method here already.
if (getenv('REDIR_TEST_DIR')) {
    die('skip Excluding from a redirected set');
}
?>
--FILE--
<?php

require_once __DIR__ . "/../config_functions.inc";

if (class_exists(PdoPgsql::class) === false) {
    echo "PdoPgsql class does not exist.\n";
    exit(-1);
}

echo "PdoPgsql class exists.\n";

$dsn = getDsn();

$db =  Pdo::connect($dsn);

if (!$db instanceof PdoPgsql) {
    echo "Wrong class type. Should be PdoPgsql but is [" . get_class($db) . "\n";
}

$db->query('DROP TABLE IF EXISTS test');
$db->exec('CREATE TABLE IF NOT EXISTS test(id int NOT NULL PRIMARY KEY, name VARCHAR(10))');
$db->exec("INSERT INTO test VALUES(1, 'A')");
$db->exec("INSERT INTO test VALUES(2, 'B')");
$db->exec("INSERT INTO test VALUES(3, 'C')");

foreach ($db->query('SELECT name FROM test') as $row) {
    var_dump($row);
}

$db->query('DROP TABLE test');

echo "Fin.";
?>
--EXPECT--
PdoPgsql class exists.
array(2) {
  ["name"]=>
  string(1) "A"
  [0]=>
  string(1) "A"
}
array(2) {
  ["name"]=>
  string(1) "B"
  [0]=>
  string(1) "B"
}
array(2) {
  ["name"]=>
  string(1) "C"
  [0]=>
  string(1) "C"
}
Fin.
