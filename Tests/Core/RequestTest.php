<?php

namespace Tests\Core;

use Core\Request;
use PHPUnit\Framework\TestCase;
use Config\System;

class RequestTest extends TestCase
{
    private static string $controllersDir;

    /**
     * Creates a temporary directory structure for controllers before running tests.
     */
    public static function setUpBeforeClass(): void
    {
        self::$controllersDir = System::CTRL_FOLDER;
        if (!is_dir(self::$controllersDir . '/Admin')) {
            mkdir(self::$controllersDir . '/Admin', 0777, true);
        }
    }

    /**
     * Removes the temporary directory structure after all tests are finished.
     */
    public static function tearDownAfterClass1(): void
    {
        if (is_dir(self::$controllersDir . '/Admin')) {
            rmdir(self::$controllersDir . '/Admin');
        }
        if (is_dir(self::$controllersDir)) {
            rmdir(self::$controllersDir);
        }
    }

    /**
     * Resets the $_GET superglobal before each test.
     */
    protected function tearDown(): void
    {
        unset($_GET[\Config\System::URL]);
    }

    /**
     * @dataProvider urlProvider
     */
    public function testParseUrl(string $url, string $expectedController, string $expectedAction, array $expectedParams): void
    {
        // Set the test URL
        $_GET[\Config\System::URL] = $url;

        // Create a Request instance, which will call parseUrl()
        $request = new Request();
        print $request->controllerName;
        // Assertions
        $this->assertSame($expectedController, $request->controllerName);
        $this->assertSame($expectedAction, $request->actionName);
        $this->assertSame($expectedParams, $request->params);
    }

    public function testParseUrlWhenNoUrlIsSet(): void
    {
        // Ensure URL is not set
        unset($_GET[\Config\System::URL]);

        $request = new Request();

        $this->assertSame(\Config\System::DEFAULT_CTRL, $request->controllerName);
        $this->assertSame('index', $request->actionName);
        $this->assertEmpty($request->params);
    }

    public function urlProvider(): array
    {
        return [
            'root URL' => [
                'url' => '',
                'expectedController' => 'home',
                'expectedAction' => 'index',
                'expectedParams' => [],
            ]
            ,
            'simple controller' => [
                'url' => 'login',
                'expectedController' => 'login',
                'expectedAction' => 'index',
                'expectedParams' => [],
            ],
            /*
            'controller and action' => [
                'url' => 'products/show',
                'expectedController' => 'Products',
                'expectedAction' => 'show',
                'expectedParams' => [],
            ],
            'controller, action, and params' => [
                'url' => 'products/show/123/abc',
                'expectedController' => 'Products',
                'expectedAction' => 'show',
                'expectedParams' => ['123', 'abc'],
            ],
            'URL with trailing slash' => [
                'url' => 'products/show/',
                'expectedController' => 'Products',
                'expectedAction' => 'show',
                'expectedParams' => [],
            ],
            'nested controller' => [
                'url' => 'admin/users/list',
                'expectedController' => 'Admin/Users',
                'expectedAction' => 'list',
                'expectedParams' => [],
            ],
            'URL points to a directory only' => [
                'url' => 'admin',
                'expectedController' => 'Admin/homeCtrl',
                'expectedAction' => 'index',
                'expectedParams' => [],
            ],
            'URL points to a directory with trailing slash' => [
                'url' => 'admin/',
                'expectedController' => 'Admin/homeCtrl',
                'expectedAction' => 'index',
                'expectedParams' => [],
            ],
            'URL with mixed case' => [
                'url' => 'aDmIn/uSeRs',
                'expectedController' => 'Admin/usersCtrl',
                'expectedAction' => 'index',
                'expectedParams' => [],
            ],*/
        ];
    }
}