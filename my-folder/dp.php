<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Amp\Mysql\MysqlConfig;
use Amp\Mysql\MysqlConnectionPool;

$config = MysqlConfig::fromString(
    "host=db01.dbhost.dev port=5051 user=user_452hwm8ax password=p452hwm8ax db=db_452hwm8ax"
);

$pool = new MysqlConnectionPool($config);
