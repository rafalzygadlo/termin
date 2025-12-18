<?php

/*
 *  
 *   userCtrl.php
 *   
 *   @category   Controller
 *   @package    Core
 *   @author     rafal zygadlo rafal@zygadlo.org
 *   @copyright  Copyright (c) 2025 zygadlo.org
 *   @license    MIT
 *  
 */



namespace Http\Ctrl;


use Core\Ctrl;
use Core\Msg;
use Core\View;
use Model\UserModel;
use Core\Request;


class userCtrl extends authCtrl 
{
    public function index()
    {
        $view = new View();
        $view->render('user/index');    
    }   

    /**
     * Show the form for editing a specific user.
     *
     * @param Request $request
     */
    public function edit(Request $request)
    {
        $id = (int) $request->getParam('id');
        $userModel = new UserModel();

        $user = $userModel->find($id); 

        // If user not found, show 404 error page
        if (!$user) {
            $view = new View('errors/404', [], false, 'errors/_layout.html');
            $view->Render();
            exit;
        }

        $view = new View('user/edit', ['user' => $user]);
        $view->render();
    }
}
