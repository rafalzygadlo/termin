<?php
    
    ini_set('log_errors', true);        // Error/Exception file logging engine.
    ini_set('error_log', 'errors.log'); // Logging file path
    ini_set("display_errors","on");
    error_reporting(E_ALL);
    
    // More reliable autoloader
    spl_autoload_register
    (
        function ($class)
        {
            // Use __DIR__ to create an absolute path
            $base_dir = __DIR__ . '/';
            $file = str_replace('\\', '/', $class) . '.php'; // Convert namespace to path
            $path = $base_dir . $file;
            if (file_exists($path)) {
                require_once $path;
            }
        }
    );

    Core\Msg::init();
    //helper functions
    function __($msg){ return Core\Msg::get($msg);  }
 
    $app = new Core\App();
    $app->Run();
    

// Closing PHP tag is omitted according to good practices (PSR-12)

    
