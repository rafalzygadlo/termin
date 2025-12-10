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
	private $checkers = array();

	public function Run(string $action, Request $request)
	{
		foreach($this->checkers as $checker)
	    {
            $checker->Run($request);
	    }
	    $this->$action($request);
	}
	
	public function AddChecker(Checker $checker)
	{
		array_push($this->checkers, $checker);
	}

	public function GetStatus()
	{	
		return true;
	}

	public function Index()
	{
		print 'Base Ctrl index';
	}	

}
