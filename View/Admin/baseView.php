<?php

namespace View\Admin;
use Core\View;

class baseView extends View
{
    
    public function __construct()
    {
        parent::__construct('home/index',  array() , false, "admin/_layout.html");
        
    }
}
