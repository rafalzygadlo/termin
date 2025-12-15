<?php
Core\Msg::init();

function __($msg)
{
    return Core\Msg::Get($msg);
}
// Closing PHP tag is omitted according to good practices (PSR-12)Core\Msg::init();