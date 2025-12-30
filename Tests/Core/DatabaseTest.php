<?php

namespace Tests\Core;

use Core\Database;
use PHPUnit\Framework\TestCase;
use PDOException;

class DatabaseTest extends TestCase
{
    public function testSingletonInstance()
    {
        try {
            $instance1 = Database::instance();
            $instance2 = Database::instance();

            $this->assertInstanceOf(Database::class, $instance1);
            $this->assertSame($instance1, $instance2, 'Database::instance() should return the same object');
        } catch (PDOException $e) {
            $this->markTestSkipped('Database connection failed: ' . $e->getMessage());
        }
    }

    public function testConstructorIsPrivate()
    {
        $reflection = new \ReflectionClass(Database::class);
        $constructor = $reflection->getConstructor();
        
        $this->assertFalse($constructor->isPublic(), 'Database constructor should be private');
    }
}