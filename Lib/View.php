<?php

namespace Lib;

class View
{
    private $template;
    
    private $template_folder;
    
    private $style;
    
    private $layout;
    
    private $values;

    private $content;

    public $ctrl_name;
    
    public function __construct($template = 'home/index', $values = array() , $content = false, $layout = "_layout.html", $style = "Style/default")
    {
        $this->content = $content;
        $this->template_folder = $style.'/templates';
        $this->template = $template;
        $this->style = $style;
        $this->layout = $layout;
        $this->values = $values;
    }

    private function include($file)
    {
        extract($this->values);
        include $this->template_folder."/".$file;
    }

    private function minimizeOutput($file)
    {
		
        ob_start(); // 
        $this->include($file);
        $output = ob_get_contents(); // This contains the output of yourtemplate.php
        // Manipulate $output...

        $search = array
        (
            '/\>[^\S ]+/s', // strip whitespaces after tags, except space
            '/[^\S ]+\</s', // strip whitespaces before tags, except space
            '/(\s)+/s', // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );

        $replace = array
        (
            '>',
            '<',
            '\\1',
            ''
        );

        $buffer = preg_replace($search, $replace, $output);
        ob_end_clean();
        return $buffer;
    }

    public function isTemplateExists($template)
    {
        $ext = pathinfo($template, PATHINFO_EXTENSION);

        if ($ext)
        {
            $filename = $this->template_folder . '/' . $template;
        }
        else
        {
            $filename = $this->template_folder . '/' . $template . '.html';
        }
		
	   if (file_exists($filename))
            return true;
        else
            return false;
    }

    private function renderPage($template)
    {
        $layout = $this->minimizeOutput($this->layout);
        $buffer = $this->minimizeOutput($template);
        
    
        $buffer = str_replace("{{content}}",$buffer,$layout);		
		return $buffer;
    }

    private function renderContent($template)
    {
         include $this->template_folder . '/' . $template;
    }

    public function renderToBuffer($template = null)
    {

        if($template)
            $this->template = $template;

        $ext = pathinfo($this->template, PATHINFO_EXTENSION);

        if ($ext)
        {
            $template = $this->template;
        }
        else
        {
            $template = $this->template . '.html';
        }

    
        if ($this->isTemplateExists($template))
        {
            if ($this->content)
                $buffer = $this->renderContent($template);
            else
                $buffer = $this->renderPage($template);
        }
		else
        {
            die('FILE NOT EXISTS: '. $template);
        }
		
		return $buffer;

    }

    public function render($template = null)
    {
        print $this->renderToBuffer($template);
		
    }
	
	

}
