<?php

use Doctrine\DBAL\Driver\PDO\PgSQL\Driver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => Driver::class,
                'params' => [
                    'host'     => 'database-trafegus.ch9ejmy7iwft.sa-east-1.rds.amazonaws.com',
//                    'host'     => 'localhost',
                    'port'     => '5432',
                    'user'     => 'postgres',
//                    'password' => 'postgres',
                    'password' => 'postgrestrafegus',
                    'dbname'   => 'trafegus',
                ],
            ],
        ],
    ],
];
