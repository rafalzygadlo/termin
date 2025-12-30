<?php

namespace Tests\Model;

use Model\UserModel;
use Core\Database;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class UserModelTest extends TestCase
{
    private $userModel;
    private $dbMock;

    protected function setUp(): void
    {
        // Create a mock of the Database class
        $this->dbMock = $this->createMock(Database::class);

        // Use Reflection to instantiate UserModel without calling __construct
        // This prevents the automatic Database::instance() call which would fail without a DB connection
        $reflection = new ReflectionClass(UserModel::class);
        $this->userModel = $reflection->newInstanceWithoutConstructor();

        // Inject the mock database into the protected $db property
        $property = $reflection->getProperty('db');
        $property->setAccessible(true);
        $property->setValue($this->userModel, $this->dbMock);
    }

    public function testLoginSuccess()
    {
        $email = 'test@example.com';
        $password = 'secret123';
        $md5Password = md5($password);

        // Expect FetchQuery to be called with specific SQL and params
        $this->dbMock->expects($this->once())
            ->method('FetchQuery')
            ->with(
                $this->stringContains('SELECT * FROM user'),
                ['email' => $email, 'password' => $md5Password]
            )
            ->willReturn([ (object)['id' => 1, 'email' => $email] ]); // Return a fake user object

        $result = $this->userModel->Login($email, $password);

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals($email, $result[0]->email);
    }

    public function testLoginFailure()
    {
        $email = 'wrong@example.com';
        $password = 'wrongpass';

        // Expect FetchQuery to return empty array
        $this->dbMock->expects($this->once())
            ->method('FetchQuery')
            ->willReturn([]);

        $result = $this->userModel->Login($email, $password);

        $this->assertFalse($result);
    }

    public function testGetAll()
    {
        $fakeUsers = [
            (object)['id' => 1, 'email' => 'a@a.com'],
            (object)['id' => 2, 'email' => 'b@b.com']
        ];

        $this->dbMock->expects($this->once())
            ->method('FetchQuery')
            ->with($this->stringContains('SELECT * FROM user'))
            ->willReturn($fakeUsers);

        $result = $this->userModel->GetAll();

        $this->assertCount(2, $result);
        $this->assertEquals('a@a.com', $result[0]->email);
    }
}