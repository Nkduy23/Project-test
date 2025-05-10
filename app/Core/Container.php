<?php

namespace App\Core;

use PDO;
use Dotenv\Dotenv;
use ReflectionClass;

class Container
{
    protected static $instances = [];
    protected static $bindings = [];

    public static function bind(string $abstract, callable|string $concrete): void
    {
        self::$bindings[$abstract] = $concrete;
    }

    public static function get(string $class)
    {
        if (isset(self::$instances[$class])) {
            return self::$instances[$class];
        }

        // Kiểm tra binding trước
        if (isset(self::$bindings[$class])) {
            $concrete = self::$bindings[$class];
            if (is_callable($concrete)) {
                return self::$instances[$class] = $concrete();
            }
            return self::$instances[$class] = self::get($concrete);
        }

        // Xử lý đặc biệt cho PDO
        if ($class === PDO::class) {
            return self::$instances[$class] = self::getPDO();
        }

        try {
            $reflector = new ReflectionClass($class);
            $constructor = $reflector->getConstructor();

            if (!$constructor) {
                return self::$instances[$class] = new $class();
            }

            $params = [];
            foreach ($constructor->getParameters() as $param) {
                $paramType = $param->getType();
                
                if (!$paramType || $paramType->isBuiltin()) {
                    // Nếu không có type hoặc là built-in type, kiểm tra default value
                    if ($param->isDefaultValueAvailable()) {
                        $params[] = $param->getDefaultValue();
                    } else {
                        throw new \RuntimeException(
                            "Cannot resolve parameter \${$param->getName()} of type " . 
                            ($paramType ? $paramType->getName() : 'mixed') . 
                            " in class {$class}"
                        );
                    }
                } else {
                    $params[] = self::get($paramType->getName());
                }
            }

            return self::$instances[$class] = $reflector->newInstanceArgs($params);
        } catch (\ReflectionException $e) {
            throw new \RuntimeException("Failed to resolve class {$class}: " . $e->getMessage());
        }
    }

    public static function getPDO(): PDO
    {
        if (isset(self::$instances[PDO::class])) {
            return self::$instances[PDO::class];
        }

        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->safeLoad();

        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        return self::$instances[PDO::class] = $pdo;
    }
}