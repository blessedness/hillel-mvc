<?php

declare(strict_types=1);

namespace System\DB\MySql;

use PDO;
use System\Config;

abstract class Model
{
    private $pdo;

    public function __construct()
    {
        $config = (new Config())->get('mysql');

        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";

        $this->pdo = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public function setAttributes(array $attributes = [])
    {
        foreach ($attributes as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->$attribute = $value;
            }
        }
    }
}
