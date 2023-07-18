--TEST--
PDO_firebird subclass basic
--EXTENSIONS--
pdo_firebird
--FILE--
<?php

require_once __DIR__ . "/../config_functions.inc";

if (class_exists(PdoFirebird::class) === false) {
    echo "PdoFirebird class does not exist.\n";
    exit(-1);
}
echo "PdoFirebird class exists.\n";


[$dsn, $user, $pass] = getDsnUserAndPassword();

$db = new PdoFirebird($dsn, $user, $pass);

$db->query('RECREATE TABLE foobar (idx int NOT NULL PRIMARY KEY, name VARCHAR(20))');
$db->query("INSERT INTO foobar VALUES (1, 'PHP')");
$db->query("INSERT INTO foobar VALUES (2, 'PHP6')");

foreach ($db->query('SELECT name FROM foobar') as $row) {
    var_dump($row);
}

$db->query('DROP TABLE foobar');

echo "Fin.";
?>
--EXPECT--
PdoFirebird class exists.
array(2) {
  ["NAME"]=>
  string(3) "PHP"
  [0]=>
  string(3) "PHP"
}
array(2) {
  ["NAME"]=>
  string(4) "PHP6"
  [0]=>
  string(4) "PHP6"
}
Fin.
