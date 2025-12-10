<?php
    
    ini_set('log_errors', true);        // Error/Exception file logging engine.
    ini_set('error_log', __DIR__ . '/errors.log'); // Logging file path
    ini_set("display_errors","on");
    error_reporting(E_ALL);
    
    require __DIR__ . '/autoload.php';

    Core\Msg::init();
    //helper functions
    function __($msg){ return Core\Msg::get($msg);  }
    
    //application start
    (new Core\App())->Run();
    

// Closing PHP tag is omitted according to good practices (PSR-12)

    
