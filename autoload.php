<?php
   
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

// Closing PHP tag is omitted according to good practices (PSR-12)

    
