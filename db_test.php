<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = \Amp\Mysql\MysqlConfig::fromString(
    "host=db01.dbhost.dev port=5051 user=user_452hwm8ax password=p452hwm8ax db=db_452hwm8ax"
);

$pool = new \Amp\Mysql\MysqlConnectionPool($config);

$rows = $pool->execute(
    "SELECT COUNT(*) AS total FROM users"
);

foreach ($rows as $row) {
    echo "Users table connected successfully! Total users: "
        . $row['total'] . PHP_EOL;
}