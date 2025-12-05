<?php

namespace Core;

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

    private function Include($file)
    {
        extract($this->values);
        include $this->template_folder."/".$file;
    }

    private function MinimizeOutput($file)
    {
		
        ob_start(); // 
        $this->Include($file);
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

    public function IsTemplateExists($template)
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

    private function RenderPage($template)
    {
        $layout = $this->MinimizeOutput($this->layout);
        $buffer = $this->MinimizeOutput($template);
        
    
        $buffer = str_replace("{{content}}",$buffer,$layout);		
		return $buffer;
    }

    private function RenderContent($template)
    {
         include $this->template_folder . '/' . $template;
    }

    public function RenderToBuffer($template = null)
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

    
        if ($this->IsTemplateExists($template))
        {
            if ($this->content)
                $buffer = $this->RenderContent($template);
            else
                $buffer = $this->RenderPage($template);
        }
		else
        {
            die('FILE NOT EXISTS: '. $template);
        }
		
		return $buffer;

    }

    public function Render($template = null)
    {
        print $this->RenderToBuffer($template);
    }
	
	

}
