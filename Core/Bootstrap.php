<?php

/**
 * Bootstrap
 * 
 * @category   Libs
 * @package    CMS
 * @author     Rafał Żygadło <rafal@maxkod.pl>
 
 * @copyright  2016 maxkod.pl
 * @version    1.0
 */
namespace Core;

use Core\Tools;
use Core\View;

class Bootstrap
{
    public $Ctrl;
    public $DefaultCtrl;       
    public $argv;
    public $Method;
    public $Param;
    public $FileName;
    
    public function __construct($argv = null)
    {
        $this->argv = $argv;
        $this->DefaultCtrl = DEFAULT_CTRL;
    }

    public function Run($argv)
    {
        $this->ReadArgv();
        $this->ReadGet();
        $this->SetDefaultCtrl();
        $this->CheckCtrlFile();
        $this->LoadController();
    }

    private function SetDefaultCtrl()
    {
        
        if (empty($this->Ctrl)) 
        {
            $this->Ctrl = $this->DefaultCtrl;
        }
    }

    private function ReadArgv()
    {
		if(isset($this->argv))
		{
		    @list($this->FileName, $this->Ctrl, $this->Method) = $this->argv;	
		}
    
    }
	
    private function ReadGet()
    {
        // parse z URL
        if(!isset($_GET[URL]))
            return;
        
            $url = ltrim($_GET[URL],"/");
            $array = (explode("/", $url));

            foreach($array as $folder)
            {
                $dir = ucfirst($folder);
                if(is_dir(CTRL_FOLDER . '/'. ($dir)))
                {
                    if(empty($this->Ctrl))
                        $this->Ctrl .= $dir;
                    else
                        $this->Ctrl .= '/'.$dir;
                }
                else
                {
                    if(empty($this->Ctrl))
                        $this->Ctrl .= $folder;
                    else
                        $this->Ctrl .= '/'.$folder;
                    break;
                }

            }

            $method = str_replace(strtolower($this->Ctrl), "", $url);
            $this->Method = trim($method, '/');
    }

    private function CheckCtrlFile()
    {
        
        $ctrl = $this->Ctrl;
        $filename = CTRL_FOLDER . '/'. $ctrl . 'Ctrl.php';

        if (file_exists($filename) == false)
        {
            $this->LoadErrorController($filename);
        }

    }

    private function LoadController()
    {
        $ctrl = str_replace("/", "\\", $this->Ctrl); 
        $classname = CTRL_FOLDER. "\\" .$ctrl.'Ctrl';
        $class = new $classname;
    
        $action = $this->Method;
		
        if(is_null($action) || empty($action))
        {
            $class->Index();
            return;
        }

		if(method_exists($class, $action))
		{
		    $class->$action();
		}
        else
        {
            $this->LoadErrorController();
            exit;
        }   

        
    }

    private function LoadErrorController()
    {
        $view = new View('errors/404');
        $view->Render();
        exit;
    }


}
