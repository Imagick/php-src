--TEST--
Postgres subclass
--EXTENSIONS--
pdo_pgsql
--REDIRECTTEST--
# Executes the pdo_pgsql testsuite using PDO::connect()

$config = [
	'TESTS' => __DIR__ . '/ext/pdo_pgsql/tests',
    'ENV' => [
        'PDOTEST_USECONNECT' => true,
    ],
];

if (false !== getenv('PDO_PGSQL_TEST_DSN')) {
	# user set them from their shell
	$config['ENV']['PDOTEST_DSN'] = getenv('PDO_PGSQL_TEST_DSN');
	if (false !== getenv('PDO_PGSQL_TEST_ATTR')) {
		$config['ENV']['PDOTEST_ATTR'] = getenv('PDO_PGSQL_TEST_ATTR');
	}
} else {
	$config['ENV']['PDOTEST_DSN'] = 'pgsql:host=localhost port=5432 dbname=test user=postgres password=postgres';
	$config['ENV']['PDOTEST_USER'] = 'postgres';
	$config['ENV']['PDOTEST_PASS'] = 'postgres';
}

return $config;
