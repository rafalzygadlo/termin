<?php

namespace Core;


abstract class Checker
{
    public abstract function Run(Request $request);
}
