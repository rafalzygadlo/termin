<?php
Core\Msg::init();

function __($msg)
{
    print Core\Msg::get($msg);
}
// Closing PHP tag is omitted according to good practices (PSR-12)Core\Msg::init();