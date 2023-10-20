<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=db;dbname=postgres_db',
    'username' => 'postgres_user',
    'password' => 'postgres123',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
