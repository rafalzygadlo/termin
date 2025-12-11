<?php

namespace Core;
use Core\Request;


abstract class Checker
{
    public abstract function Run(Request $request);
}
