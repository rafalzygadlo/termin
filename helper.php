<?php

function _msg($key)
{
    static $trans = null;

    if ($trans === null) 
    {
        $lang = \Core\Session::Get('lang', 'en');
        $path = __DIR__ . "/Lang/$lang.php";
        $trans = file_exists($path) ? require $path : [];
    }

    return $trans[$key] ?? '_' . $key . '_';
}

// template functions
// display field value
function _val($array,$key)
{
    return htmlspecialchars($array[$key] ?? '', ENT_QUOTES, 'UTF-8');
}

//display invalid class for form fields
function _inv($array,$key)
{
    return isset($array[$key]) ? ' is-invalid ' : '';
}

function _errors($array, $key)
{
    $msg = null;
    if (isset($array[$key]))
    {
        foreach ($array[$key] as $error)
        {
            $msg .= "<div class=\"invalid-feedback\">" . ($error) . "</div>";
        }
    }
    return $msg;
}
