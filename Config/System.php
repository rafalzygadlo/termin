<?php

namespace Config;

class System
{
    public const DEBUG = true;
    public const DEFAULT_CTRL = 'home';

    // URL indexes in the array after exploding the URL
    public const URL_CTRL = 0;
    public const URL_METHOD = 1;
    public const URL_PARAM = 2;

    // For rewrite engine
    public const CTRL = "ctrl";
    public const METHOD = "method";
    public const URL = "url";
    public const CTRL_FOLDER = 'Http/Ctrl';
    public const CTRL_SUFFIX = 'Ctrl';
}