<?php

/**
 * Ctrl
 * 
 * @category   Ctrl
 * @package    Mass-Symfonia
 * @author     Rafał Żygadło <rafal@maxkod.pl>

 * @copyright  2018 maxkod.pl
 * @version    1.0
 */


namespace Core;

abstract class Ctrl
{

    public $Model;
    public $Ctrl;

	public function GetStatus()
	{	
		return true;
	}

	public function index()
	{
		print '<h1>Base Ctrl index</h1>';
	}	

}
