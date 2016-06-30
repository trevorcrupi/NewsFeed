<?php

namespace Nucleus\Database\Factory;

class DatabaseFactory
{
    private static $factory;
    private $database;

    private $devMode = true;

    public static function getFactory()
    {
        if (!self::$factory) {
            self::$factory = new DatabaseFactory();
        }
        return self::$factory;
    }

    public function getConnection() {
        if (!$this->database) {
          // Set up database connection data
          $conn = array(
            'driver'   => 'pdo_mysql',
            'host'     => '127.0.0.1',
            'dbname'   => 'communicode',
            'user'     => 'root',
            'password' => ''
          );

          $entityManager = EntityManager::create($conn, $config);

          return $entityManager;
        }

        return $this->database;
    }
}
