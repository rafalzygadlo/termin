<?php

/**
 * userCtrl
 * 
 * @category   Controller
 * @package    CMS
 * @author     Rafał Żygadło <rafal@maxkod.pl>
 
 * @copyright  2016 maxkod.pl
 * @version    1.0
 */
// FORM user new,edit


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

        $user = $userModel->find($id); // Zakładam, że model ma metodę find() do szukania po ID

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
