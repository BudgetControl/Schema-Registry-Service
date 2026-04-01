<?php

return [
    'paths' => [
        'migrations' => 'resources/migrations',
    ],
    'migration_template_file' => 'resources/migrations/template.php',
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'default',
        'default' => [
            'adapter' => 'pgsql',
            'host'    => getenv('DB_HOST') ?: 'localhost',
            'name'    => getenv('DB_NAME') ?: 'budgetcontrol',
            'user'    => getenv('DB_USER') ?: 'postgres',
            'pass'    => getenv('DB_PASSWORD') ?: '',
            'port'    => getenv('DB_PORT') ?: '5432',
        ],
    ],
];
