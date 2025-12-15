<?php

return [
    'GET' => [
        '/' => ['Http\Ctrl\homeCtrl', 'index'],
        '/login' => ['Http\Ctrl\loginCtrl', 'index'],
        '/register' => ['Http\Ctrl\registerCtrl', 'index'],
        '/logout' => ['Http\Ctrl\logoutCtrl', 'index'],
        '/dashboard' => ['Http\Ctrl\dashboardCtrl', 'index'],
        '/terms' => ['Http\Ctrl\termsCtrl', 'index'],
        '/privacy' => ['Http\Ctrl\privacyCtrl', 'index'],
        '/user' => ['Http\Ctrl\userCtrl', 'index'],
        '/password' => ['Http\Ctrl\passwordCtrl', 'index'],
        '/password/reset' => ['Http\Ctrl\passwordCtrl', 'reset'],
    ],
    'POST' => [
        '/login/do' => ['Http\Ctrl\loginCtrl', 'do'],
        '/register/do' => ['Http\Ctrl\registerCtrl', 'do'],
        '/password/do' => ['Http\Ctrl\passwordCtrl', 'do'],
        '/password/reset' => ['Http\Ctrl\passwordCtrl', 'reset'],
    ],
    
     'PUT' => [],
     'DELETE' => [],
];