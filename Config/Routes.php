<?php

return [
    'GET' => [
        '/' => ['Ctrl\homeCtrl', 'index'],
        '/home' => ['Ctrl\homeCtrl', 'index'],
        '/login' => ['Ctrl\loginCtrl', 'index'],
        '/register' => ['Ctrl\registerCtrl', 'index'],
        '/logout' => ['Ctrl\logoutCtrl', 'index'],
        '/dashboard' => ['Ctrl\dashboardCtrl', 'index'],
        '/terms' => ['Ctrl\termsCtrl', 'index'],
        '/privacy' => ['Ctrl\privacyCtrl', 'index'],
        '/user/edit/{id}' => ['Ctrl\userCtrl', 'edit'],
        '/user' => ['Ctrl\userCtrl', 'index'],
        '/password' => ['Ctrl\passwordCtrl', 'index'],
        '/password/reset' => ['Ctrl\passwordCtrl', 'reset'],
        '/profile' => ['Ctrl\profileCtrl', 'index'],
        '/profile/edit' => ['Ctrl\profileCtrl', 'edit'],
        '/settings' => ['Ctrl\settingsCtrl', 'index'],
        '/settings/edit' => ['Ctrl\settingsCtrl', 'edit'],
        '/admin/home' => ['Ctrl\Admin\homeCtrl', 'index'],
    ],
    'POST' => [
        '/login/do' => ['Ctrl\loginCtrl', 'do'],
        '/register/do' => ['Ctrl\registerCtrl', 'do'],
        '/password/do' => ['Ctrl\passwordCtrl', 'do'],
        '/password/reset' => ['Ctrl\passwordCtrl', 'reset'],
    ],
    
     'PUT' => [],
     'DELETE' => [],
];